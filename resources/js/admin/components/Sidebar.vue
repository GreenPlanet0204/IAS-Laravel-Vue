<template>
    <ul
      class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion"
      id="accordionSidebar"
    >
      <!-- Sidebar - Brand -->
      <router-link
        class="sidebar-brand d-flex align-items-center justify-content-center"
        to="/"
      >
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3" @click="userFrontendShow">Lifeanalytics</div>
      </router-link>

      <!-- Divider -->
      <hr class="sidebar-divider my-0" />

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <router-link class="nav-link" to="/admin/dashboard">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>{{$t('title_dashboard')}}</span>
          </router-link>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Heading -->
      <div class="sidebar-heading">Interface</div>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <router-link class="nav-link" to="/admin/users">
          <i class="fas fa-fw fa-user"></i>
          <span>{{$t('title_users')}}</span>
        </router-link>
      </li>

      <li class="nav-item">
        <router-link class="nav-link" to="/admin/applications">
          <i class="fas fa-list fa-sm fa-fw"></i>
          <span>{{$t('applications.title')}}</span>
        </router-link>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <div
          id="collapseUtilities"
          class="collapse"
          aria-labelledby="headingUtilities"
          data-parent="#accordionSidebar"
        >
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <router-link class="collapse-item" to="/admin/utilities/colors">Colors</router-link>
            <router-link class="collapse-item" to="/admin/utilities/borders">Borders</router-link>
            <router-link class="collapse-item" to="/admin/utilities/animations"
              >Animations</router-link
            >
            <router-link class="collapse-item" to="/admin/utilities/other">Other</router-link>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider" />

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <!-- End of Sidebar -->
</template>

<script>

export default {
  name: 'Sidebar',
  methods: {
    userFrontendShow() {
      this.$emit("transfer_user_admin", true)
    }
  }
}
</script>
