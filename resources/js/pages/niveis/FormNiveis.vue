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
                                <b-button variant="success">Cadastrar</b-button>
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
             form:{
                 niveis:''
             }
         }
     },
     methods:{
         cancel(){
             return this.$router.push("/niveis")
         }
     }
 }

</script>

<style>

</style>