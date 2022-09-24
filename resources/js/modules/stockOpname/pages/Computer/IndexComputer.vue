<template>
    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Computers</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">List Computer</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->


        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-12 connectedSortable" v-once>
                        <card>
                            <template #content>
                            </template>
                        </card>
                    </section>
                <!-- /.Left col -->
                </div>

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
</template>

<script setup>

</script>


<style scoped>
.pc_section ul {
    margin: 0;
    padding: 0;


}

.pc_section li {
        list-style: none;
        border: 1px solid rgb(232, 232, 232);
        padding: 10px 14px;
        margin-bottom: 1rem;
        border-radius: 4px;
        box-shadow: rgba(0, 0, 0, 0.15) 1.95px 1.95px 2.6px;
    }

.pc_section li h2 {
    font-size: 12px;
}
</style>
