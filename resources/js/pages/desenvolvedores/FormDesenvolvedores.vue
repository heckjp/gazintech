<template>
    <b-container fluid>
        <b-row>
            <b-col>
            <h1>Cadastro de Desenvolvedores</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col sm="12" md="9" class="mx-auto">
                <b-card class="shadow">
                    <b-form>
                        <b-form-group 
                            label="Nome"
                            label-for="input-nome"
                            description="Nome do desenvolvedor"
                        >
                            <b-form-input 
                                id="input-nome"
                                v-model="form.nome"
                                placeholder="Nome do desenvolvedor"
                            >
                            </b-form-input>
                        </b-form-group>

                        <b-form-radio-group
                            v-model="form.sexo"
                            :options="sexo"
                            class="mb-3"
                            value-field="value"
                            text-field="text"
                            >
                        </b-form-radio-group>
                        
                        <b-form-group 
                            label="Data de nascimento"
                            label-for="input-datanascimento"
                        >
                            <b-form-input 
                                id="input-nome"
                                type="date"
                                v-model="form.datanascimento"
                                placeholder="Data de nascimento"
                            >
                            </b-form-input>
                        </b-form-group>
                        <b-form-group 
                            label="Idade"
                            label-for="input-idade"
                            description="Idade do desenvolvedor"
                        >
                            <b-form-input 
                                id="input-idade"
                                v-model="form.idade"
                                placeholder="Informe a idade"
                                type="number"
                            >
                            </b-form-input>
                        </b-form-group>

                        <b-form-group 
                                label-for="select-nivel" 
                                label="Nível" 
                                description="Nível de senioridade do desenvolvedor"
                        >
                            <b-form-select v-model="form.nivel" id="select-nivel">
                                <b-form-select-option
                                        v-for="level in levels" 
                                        :value="level.id" 
                                        v-bind:key="level.nivel"
                                        >
                                            {{level.nivel}}
                                </b-form-select-option>
                            </b-form-select>
                        </b-form-group>

                        <b-form-group 
                            label="Hobby"
                            label-for="input-hobby"
                            description="Idade do desenvolvedor"
                        >
                            <b-form-input 
                                id="input-hobby"
                                v-model="form.hobby"
                                placeholder="Informe o hobby"
                            
                            >
                            </b-form-input>
                        </b-form-group>
                        <b-row>
                            <b-col align="right">
                                <b-button variant="danger" v-on:click="cancel()">Cancelar</b-button>
                                <b-button variant="success" v-on:click="save()">Cadastrar</b-button>
                            </b-col>
                        </b-row>
                    </b-form>
                </b-card>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
 export default {
     name:'FormDesenvolvedores',
     data(){
         return {
             apiurl: process.env.MIX_API_URL,
             levels:[],
             form:{
                 nome:'',
                 idade:0,
                 sexo:'',
                 datanascimento:'',
                 hobby:'',
                 nivel:''
             },
             sexo: [
                { text: 'Masculino', value: 'masculino' },
                { text: 'Feminino', value: ' feminino' },
         
            ]
         }
     },
     methods:{
         cancel(){
             return this.$router.push("/desenvolvedores")
         },
          save(){
              var vm= this;
               if(!vm.$route.params.id){
                    vm.$http.post(vm.apiurl+"/developer",vm.form).then(res=>{
                            vm.$swal.fire({
                                title:"Cadastro realizado com sucesso",
                                icon:'success',
                                onClose: () =>{
                                    vm.$router.push("/desenvolvedores")
                                }
                            })
                    }).catch((err)=>{
                        console.log(err,'error')
                    })
               } else {
                   let id=vm.$route.params.id;
                   vm.$http.put(vm.apiurl+"/developer/"+id,vm.form).then(res=>{
                        vm.$swal.fire({
                                title:"Cadastro editado com sucesso",
                                icon:'success',
                                onClose: () =>{
                                    vm.$router.push("/desenvolvedores")
                                }
                            })
                    }).catch((err)=>{
                        console.log(err,'error')
                    })
               }
          },
           getLevels: function (){
             this.$http.get(this.apiurl+"/level").then((result)=>{
                 this.levels = result.data;
             })
         },
          getEditData(){
            var vm =this;
            if(vm.$route.params.id){
                let id= vm.$route.params.id;
               vm.$http.get(vm.apiurl+"/developer/"+id).then(function(response){
                   console.log('response', response)
                   vm.form = response.data
                   console.log(vm.form)
               }) 
            }
            else{
                console.log('é cadastro novo')
            }
        }
     },
     mounted(){
         this.getLevels()
         this.getEditData()
     }
 }

</script>

<style>

</style>