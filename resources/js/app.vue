<template>
  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

    <!-- the navbar -->
    <the-navbar></the-navbar>
    <!-- the navbar -->

    <!-- the sidebar -->
    <the-sidebar></the-sidebar>
    <!-- the sidebar -->

  <!-- Content Wrapper. Contains page content -->
    <the-content></the-content>
  <!-- /.content-wrapper -->

    <the-footer></the-footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</template>

<script>
import TheContent from './component/TheContent.vue'
import TheFooter from './component/TheFooter.vue'
import TheNavbar from './component/TheNavbar.vue'
import TheSidebar from './component/TheSidebar.vue'
export default {
    components: { TheNavbar, TheFooter, TheSidebar, TheContent },
    data() {
        return {
            messages: []
        }
    },
    created() {

    }
}
</script>
