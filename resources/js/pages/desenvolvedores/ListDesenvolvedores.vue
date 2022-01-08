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
                <b-table striped :fields="fields" :items="developers"  table-variant="dark" sort-by  >
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
     name:'ListDesenvolvedores',
     data(){
         return{
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
         getDevelopers: function (){
             this.$http.get("/api/developer").then((result)=>{
                 this.developers = result.data;
                 console.log(this.developers,'developers')
             })
         }
     },
     mounted(){
         this.getDevelopers()
     }
 }

</script>

<style>

</style>