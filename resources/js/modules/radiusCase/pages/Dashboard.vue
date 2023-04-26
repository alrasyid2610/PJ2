<template>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-12">
                    <h3>Dashboard Radius <Button icon="pi pi-plus" severity="info" aria-label="Notification" size="small" /> </h3>
                </div>
                <section class="col-lg-6" v-once>
                    <DayReport />
                </section>
                <section class="col-lg-6 mt-4 md:mt-0">
                    <WeeklyReport />
                </section>
            <!-- /.Left col -->
            </div>

            <div class="row">
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <Toast position="bottom-right" />
</template>

<script setup>
import WeeklyReport from "./../component/WeeklyReport.vue"
import DayReport from "./../component/DayReport.vue"
</script>
