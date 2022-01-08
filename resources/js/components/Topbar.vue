 <template>
 <b-navbar toggleable="lg" type="dark" variant="dark" class="px-2">
    <b-navbar-brand href="#">
    <b-icon-list  v-b-toggle.sidebar-1></b-icon-list>
    </b-navbar-brand>

    <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

    <b-collapse id="nav-collapse" is-nav>
      <b-navbar-nav>
        <b-nav-item to="/desenvolvedores">Desenvolvedores</b-nav-item>
        <b-nav-item to="/niveis">Niveis</b-nav-item>
      </b-navbar-nav>

      <!-- Right aligned nav items -->
      <b-navbar-nav class="ms-auto">
    

        <b-nav-item-dropdown right>
          <!-- Using 'button-content' slot -->
          <template #button-content>
            <b-icon-person></b-icon-person>
          </template>
          <b-dropdown-item href="#">Alterar Senha</b-dropdown-item>
          <b-dropdown-item href="/login">Sair</b-dropdown-item>
        </b-nav-item-dropdown>
      </b-navbar-nav>
    </b-collapse>
  </b-navbar>
  </template>

  <script>
    export default {
        name: 'Topbar'
    }
  </script>