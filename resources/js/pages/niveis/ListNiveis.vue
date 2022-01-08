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
                <b-table striped :fields="fields" :items="levels" table-variant="dark" sort-by>
                    <template v-slot:cell(action)="row">
                        <b-button variant="dark" class="m-2" v-b-modal="'modal-edit'" v-on:click="edit(row.item)" ><b-icon-pencil-square />Editar</b-button>
                     
                        <b-button variant="dark" @click="deleteLevel(row.item.id)"><b-icon-trash />Excluir</b-button>
                    </template>
                </b-table>
            </b-col>
        </b-row>
    </b-container>
</template>

<script>
 export default {
     name:'ListNiveis',
     data () {
         return {
             apiurl: process.env.MIX_API_URL,
             levels:[],
             search:'',
             fields:[
                {key:'nivel', label: 'Nivel'},
              
            ]
         }
     },
      methods:{
         newLevel() {
             this.$router.push("/niveis/novo");
         },
          getLevels: function (){
             this.$http.get(this.apiurl+"/level").then((result)=>{
                 this.levels = result.data;
                 console.log(this.levels,'levels')
             })
         },
         deletelevel: function(){
              this.$swal.fire({
                title: 'Delete album?',
                text: "The album with code "+id +" will be removed permanently",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText:'No'
}).then(response=>{
                if(response.isConfirmed) {
                vm.$http.delete(this.apiurl+'/level/'+id,{
                headers:{
                    Authorization: process.env.MIX_API_KEY
                }}).then(function(response){
                    vm.$swal.fire('Album deleted!','','success');
                    vm.getAlbums();
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
         this.getLevels()
     }
 }

</script>

<style>

</style>