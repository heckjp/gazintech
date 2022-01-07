<template>
    <b-container fluid>
         <Sidebar></Sidebar>
        <Topbar></Topbar>
       
 </b-container>
</template>


<script>
import Topbar from './Topbar.vue';
import Sidebar from './Sidebar.vue';
export default{
    name:'App',
    components: {
        Topbar, Sidebar
    },
    data(){
        return {

        }
    }
}
</script>

<style>

</style>
