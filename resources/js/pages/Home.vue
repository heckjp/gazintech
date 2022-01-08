<template>
<b-container fluid>
    <Topbar></Topbar>
    <Sidebar></Sidebar>
    <router-view></router-view>
</b-container>
</template>

<script>
    import Topbar from '../components/Topbar.vue'
    import Sidebar from '../components/Sidebar.vue'
    export default {
        name: 'Home',
        components: {
            Topbar,Sidebar
        }
    }
</script>

<style></style>