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
                <b-input 
                    name="filter" 
                    v-model="filter" 
                    placeholder="Digite para pesquisar">
                </b-input>
            </b-col>
         </b-row>
        <b-row class="mt-4">
            <b-col>
                <b-table striped :fields="fields" 
                         :items="developers"  
                         table-variant="light" 
                         id="developers-table" 
                         :per-page="perPage"
                         sort-by.sync="sortBy" 
                         :filter="filter"
                        :sort-desc.sync="sortDesc"
                         sort-icon-left
                        :current-page="currentPage"
                >
                       <template v-slot:cell(datanascimento)="data">
                        {{data.value | moment("DD/MM/YYYY")}}
                    </template>
                  
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
            filter:"",
            perPage:10,
            sortBy:'nome',
            sortDesc:false,
              developers:[],
              search:'',
               fields:[
                {key:'nome', label: 'Nome', sortable:true,},
                {key:'datanascimento',label: 'Data de nascimento',sortable:true },
                {key:'idade',label: 'Idade',sortable:true },
                {key:'sexo',label: 'Sexo',sortable:true },
                {key:'niveis.nivel', label:'Nível',sortable:true },
                {key:'action', label: "Ações", sortable:false}
            ]
         }
     },
     methods:{
         newDeveloper() {
             this.$router.push("/desenvolvedores/novo");
         },
         async getDevelopers(){
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
                         vm.$swal.fire({
                                title:"Cadastro editado com sucesso",
                                icon:'success',
                                onClose: () =>{
                                    vm.$router.push("/desenvolvedores")
                                }
                            })
                    })
                    }
                }).catch(err =>{
                   vm.$swal.fire({
                        title:"Erro ao excluir cadastro",
                        icon:'error',
                        onClose: () =>{
                            vm.$router.push("/desenvolvedores")
                        }
                    })
                })
            },
       
            
     },
     mounted(){
         this.getDevelopers()
     },
     computed: {
      rows() {
        return this.developers.length
      },
      


      
    }
 }

</script>

<style>

</style>