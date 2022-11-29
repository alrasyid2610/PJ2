<template>
     <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <router-link to="/" class="brand-link">
        <img src="/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </router-link>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <router-link to="/" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                    Dashboard
                    </p>
                </router-link>
            </li>
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-desktop nav-icon"></i>
              <p>
                Computer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <!-- <a href="pages/mailbox/mailbox.html" class="nav-link"> -->
                <!-- </a> -->
                <router-link to="/stock-opname/create" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Input Computer - Stock Opname</p>
                </router-link>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa-solid fa-file nav-icon"></i>
              <p>
                DNPI License
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <!-- <a href="pages/mailbox/mailbox.html" class="nav-link"> -->
                <!-- </a> -->
                <router-link to="/license/create" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>List License</p>
                </router-link>
              </li>
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
export default {

}
</script>
