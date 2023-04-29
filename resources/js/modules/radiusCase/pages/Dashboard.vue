<template>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-12">
                    <h3>Dashboard Radius <Button icon="pi pi-plus" severity="info" aria-label="Notification" size="small" /> </h3>
                </div>
                <section class="col-lg-6">
                    <div class="row">
                        <div class="col-12">
                            <DayReport :case-per-day="casePerDay" title-name="Yesterday" day="1"/>
                        </div>

                        <div class="col-12">
                            <DayReport :case-per-day="casePer7Day" title-name="7 Days" day="7"/>
                        </div>
                    </div>
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
import WeeklyReport from "./../component/WeeklyReport.vue";
import DayReport from "./../component/DayReport.vue";
import { onMounted, ref } from "vue";


// test
const namas = ref('');
const casePerDay = ref('')
const casePer7Day = ref('')
// end test


onMounted(() => {
    const getCasePerDay = async () => {
        try {
            const resp = await axios.get('/api/getRadiusCase/getCasePerDay');
            casePerDay.value = resp.data;
            // cases.value = resp.data;
            // console.log(resp)
            // console.log(cases.value);
        } catch (err) {
            // Handle Error Here
            console.error(err);
            toast.add({ severity: 'info', summary: "Form Submited", detail: err, life: 3000 });
        }
    }

    const getCasePer7Day = async () => {
        try {
            const resp = await axios.get('/api/getRadiusCase/getCasePerDay?day=7');
            casePer7Day.value = resp.data;
            // cases.value = resp.data;
            console.log(resp.data);
            // console.log(cases.value);
        } catch (err) {
            // Handle Error Here
            console.error(err);
            toast.add({ severity: 'info', summary: "Form Submited", detail: err, life: 3000 });
        }
    }

        const getCases = async () => {
            try {
                const resp = await axios.get('/api/radiusCase');
                // this.cases = resp.data;
                // console.log(resp);
            } catch (err) {
                // Handle Error Here
                console.error(err);
                toast.add({ severity: 'info', summary: "Form Submited", detail: err, life: 3000 });
            }
        };



    getCases();
    getCasePerDay();
    getCasePer7Day();
})
</script>
