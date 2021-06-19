<template>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <Sidebar />

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <Topbar />

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="row">
                        <nuxt />
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; ERP NUXT 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->
</template>     

<script>

import Sidebar from '~/components/Sidebar'
import Topbar from '~/components/Topbar'

export default {
    components: {
        Sidebar,
        Topbar
    }
}
</script>
<style>
    
</style>