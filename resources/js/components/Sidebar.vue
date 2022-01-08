<template>
    <b-sidebar id="sidebar-1" title="Menu" shadow >
        <div class="px-3 py-2">
          <p><router-link to="/desenvolvedores">Desenvolvedores</router-link></p>
          </p><router-link to="/niveis">Niveis</router-link></p>
        </div>
    </b-sidebar>
</template>

<script>
    export default {
        name: 'Sidebar'
    }
</script>
