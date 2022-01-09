<template>
    <b-container fluid>
        <b-row>
            <b-col>
                <h1>Cadastro de Níveis</h1>
            </b-col>
        </b-row>
        <b-row>
            <b-col sm="12" md="9" class="mx-auto">
                <b-card class="shadow">
                    <b-form>
                        <b-form-group 
                            label="Nível"
                            label-for="input-nivel"
                            description="Nivel de senioridade dos desenvolvedores"
                        >
                            <b-form-input 
                                id="input-nivel"
                                v-model="form.nivel"
                                placeholder="Digite o nivel"
                            >
                            </b-form-input>
                        </b-form-group>
                        <b-row>
                            <b-col align="right">
                                <b-button variant="danger" v-on:click="cancel()">Cancelar</b-button>
                                <b-button variant="success"  v-on:click="save()">Cadastrar</b-button>
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
     name:'FormNiveis',
     data(){
         return {
             apiurl: process.env.MIX_API_URL,
             form:{
                 nivel:''
             }
         }
     },
     methods:{
         cancel(){
             return this.$router.push("/niveis")
         },
          save(){
              var vm= this;
               if(!vm.$route.params.id){
                    vm.$http.post(vm.apiurl+"/level",vm.form).then(res=>{
                        vm.$swal.fire({
                                title:"Cadastro realizado com sucesso",
                                icon:'success',
                                onClose: () =>{
                                    vm.$router.push("/niveis")
                                }
                            })
                    }).catch((err)=>{
                         vm.$swal.fire({
                                title:"Erro ao cadastrar",
                                icon:'success',
                                onClose: () =>{
                                    vm.$router.push("/niveis")
                                }
                            })
                    })
               } else {
                    let id=vm.$route.params.id;
                   vm.$http.put(vm.apiurl+"/level/"+id,vm.form).then(res=>{
                        vm.$swal.fire({
                                title:"Cadastro editado com sucesso",
                                icon:'success',
                                onClose: () =>{
                                    vm.$router.push("/niveis")
                                }
                            })
                    }).catch((err)=>{
                        vm.$swal.fire({
                                title:"Erro ao editar cadastro",
                                icon:'error',
                                onClose: () =>{
                                    vm.$router.push("/niveis")
                                }
                            })
                    })
               }
          },
          getEditData(){
            var vm =this;
            if(vm.$route.params.id){
                console.log('é edição')
                let id= vm.$route.params.id;
               vm.$http.get(vm.apiurl+"/level/"+id).then(function(response){
                   vm.form = response.data
               }) 
            }
            else{
                console.log('é cadastro novo')
            }
          }
     },
      mounted(){
         this.getEditData()
     }
 }

</script>

<style>

</style>