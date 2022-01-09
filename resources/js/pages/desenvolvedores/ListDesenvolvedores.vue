<template>
    <b-container fluid>
        <b-row>
            <b-col>
                <h1>Desenvolvedores</h1>
            </b-col>
             <b-col>
                <b-button variant="dark" v-on:click="newDeveloper()">Novo</b-button>
            </b-col>
        </b-row>
        <b-row class="mt-4">
            <b-col>
                <b-table striped :fields="fields" 
                         :items="developers"  
                         head-variant="dark" 
                         id="developers-table" 
                         :per-page="perPage"
                        :current-page="currentPage"
                >
                      <template v-slot:cell(action)="row">
                        <b-button variant="dark" class="m-2" v-b-modal="'modal-edit'" v-on:click="edit(row.item)" ><b-icon-pencil-square />Editar</b-button>
                     
                        <b-button variant="dark" @click="deleteDeveloper(row.item.id)"><b-icon-trash />Excluir</b-button>
                    </template>
                </b-table>
            </b-col>
        </b-row>
        <b-row>
            <b-col>
                 <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    aria-controls="developers-table"
                    ></b-pagination>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
 export default {
     name:'ListDesenvolvedores',
     data(){
         return{
             
            apiurl: process.env.MIX_API_URL,
            currentPage:1,
            perPage:10,
              developers:[],
              search:'',
               fields:[
                {key:'nome', label: 'Nome'},
                {key:'datanascimento',label: 'Data de nascimento' },
                {key:'idade',label: 'Idade' },
                {key:'sexo',label: 'Sexo' },
                {key:'nivel', label:'Nível'},
                {key:'action', label: "Ações"}
            ]
         }
     },
     methods:{
         newDeveloper() {
             this.$router.push("/desenvolvedores/novo");
         },
         getDevelopers(){
             this.$http.get(this.apiurl+"/developer").then((result)=>{
                 this.developers = result.data;
             })
         },
         edit(item){
             var vm = this;
             vm.$router.push("/desenvolvedores/"+item.id);
         },
           deleteDeveloper: function(id){
               var vm= this;
              vm.$swal.fire({
                title: 'Excluir desenvolvedor?',
                text: "O cadastro será removido permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText:'Não'
                }).then(response=>{
                    if(response.isConfirmed) {
                    vm.$http.post(vm.apiurl+'/developer/'+id,{_method: 'DELETE'}).then(function(response){
                        vm.$swal.fire('Desenvolvedor excluído com sucesso!','','success');
                        vm.getDevelopers();
                    }).catch(function(err){
                        console.log(err)
                    })
                    }
                }).catch(err =>{
                    console.log(err)
                })
            }
     },
     mounted(){
         this.getDevelopers()
     },
     computed: {
      rows() {
        return this.developers.length
      }
    }
 }

</script>

<style>

</style>