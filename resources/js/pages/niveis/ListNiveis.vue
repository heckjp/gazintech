<template>
    <b-container fluid>
        <b-row>
            <b-col>
            <h1>Níveis</h1>
            </b-col>
            <b-col class="ms-auto">
            <b-button variant="dark" v-on:click="newLevel()">Novo</b-button>
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
                <b-table striped 
                        :fields="fields" 
                        :items="levels" 
                        :filter="filter"
                         table-variant="light" 
                         id="levels-table" 
                         sort-by.sync="sortBy"
                         :sort-desc.sync="sortDesc"
                         sort-icon-left
                         :per-page="perPage"
                        :current-page="currentPage">
                    <template v-slot:cell(action)="row">
                        <b-button variant="dark" class="m-2" v-b-modal="'modal-edit'" v-on:click="edit(row.item)" ><b-icon-pencil-square />Editar</b-button>
                     
                        <b-button variant="dark" @click="deleteLevel(row.item.id)"><b-icon-trash />Excluir</b-button>
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
                    aria-controls="levels-table"
                    ></b-pagination>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
 export default {
     name:'ListNiveis',
     data () {
         return {
             filter:"",
             perPage:10,
             currentPage:1,
             apiurl: process.env.MIX_API_URL,
             levels:[],
             search:'',
              sortBy:'nivel',
            sortDesc:false,
             fields:[
                {key:'nivel', label: 'Nivel', sortable:true},
                {key:'numeroDesenvolvedores', label: 'Desenvolvedores', sortable:false},
                {key:'action', label: 'Ações', sortable:false},
            ]
         }
     },
      methods:{
         newLevel() {
             this.$router.push("/niveis/novo");
         },
          getLevels: function (){
            var vm = this;
             vm.$http.get(vm.apiurl+"/level").then((result)=>{
                 vm.levels = result.data;
                 vm.levels.forEach((value,index)=>{
                     vm.$http.get(vm.apiurl+"/developer-count/"+value.id).then((res)=>{
                         vm.levels[index]['numeroDesenvolvedores']= res.data
                         if(vm.levels.length -1 == index){
                         this.$root.$emit('bv::refresh::table', 'levels-table')
                         }
                     })
                 })
                 console.log(vm.levels,'levels')
             })
         },
          edit(item){
             var vm = this;
             vm.$router.push("/niveis/"+item.id);
         },
         deleteLevel(id){
            var vm= this;
              vm.$swal.fire({
                title: 'Excluir nível?',
                text: "O registro será excluído permanentemente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Sim',
                cancelButtonText:'Não'
                }).then(response=>{
                if(response.isConfirmed) {
                    vm.$http.post(vm.apiurl+'/level/'+id,{_method: 'DELETE'}).then(function(response){
                        vm.$swal.fire('Nível excluído','','success');
                        vm.getLevels();
                    }).catch(function(err){
                        vm.$swal.fire({
                                title:"Erro ao excluir cadastro",
                                icon:'error',
                                onClose: () =>{
                                    vm.$router.push("/niveis")
                                }
                            })
                    })
                }
            }).catch(err =>{
               vm.$swal.fire({
                    title:"Erro ao excluir cadastro",
                    icon:'error',
                    onClose: () =>{
                        vm.$router.push("/niveis")
                    }
                })
            })
            
        }
     },
     mounted(){
         this.getLevels()
     },
      computed: {
      rows() {
        return this.levels.length
      }
    }
 }

</script>

<style>

</style>