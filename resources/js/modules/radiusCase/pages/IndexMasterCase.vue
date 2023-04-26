<template>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-12">
                    <h3>Radius Histories <Button icon="pi pi-plus" severity="info" aria-label="Notification" size="small" /> </h3>
                </div>
                <section class="col-lg-4" v-once>
                        <form @submit="onSubmit">
                            <card>
                                <template #content>
                                    <div class="form-group">
                                        <label for="case">Case</label>
                                        <!-- <input-text class="p-inputtext-sm w-100 forn-control" placeholder="No EDP Fix Asset" v-model="case"></input-text> -->
                                        <Dropdown v-model="selectedCase" name="case" :options="cases" optionLabel="case" placeholder="Select a City" class="w-full w-100" :class="{ 'p-invalid': errorCase }" required />
                                        <small id="username2-help" class="p-error" v-if="errorCase">{{ errorCase || '&nbsp;' }}</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="plant">Plant</label>
                                        <!-- <input-text class="p-inputtext-sm w-100 forn-control" placeholder="No EDP Fix Asset" v-model="case"></input-text> -->
                                        <Dropdown v-model="selectedPlant" :options="plants" optionLabel="name" placeholder="Select a Plant" class="w-full w-100" :class="{ 'p-invalid': errorPlant }" />
                                        <small id="username2-help" class="p-error" v-if="errorPlant">{{ errorPlant || '&nbsp;' }}</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="site">Site</label>
                                        <!-- <input-text class="p-inputtext-sm w-100 forn-control" placeholder="No EDP Fix Asset" v-model="case"></input-text> -->
                                        <Dropdown v-model="selectedSite" name="site" :options="sites" optionLabel="name" placeholder="Select a Site" class="w-full w-100" :class="{ 'p-invalid': errorSite }" />
                                        <small id="username2-help" class="p-error" v-if="errorSite">{{ errorSite || '&nbsp;' }}</small>
                                    </div>




                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal FA</label>
                                        <!-- <input type="datetime-local" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> -->
                                        <Calendar showTime showButtonBar hourFormat="24" class="w-100" v-model="date_case" name="date" :class="{ 'p-invalid': errorDate }" />
                                        <small id="username2-help" class="p-error" v-if="errorDate">{{ errorDate || '&nbsp;' }}</small>
                                    </div>

                                    <div class="form-group">
                                        <Button label="Submit" type="submit"/>
                                    </div>
                                </template>
                            </card>
                        </form>
                </section>
                <section class="col-lg-8">
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
import { ref, onMounted, computed } from "vue";
import {parse, stringify, toJSON, fromJSON} from 'flatted';
import * as Yup from "yup";
import { useToast } from 'primevue/usetoast';
import { useField, useForm } from 'vee-validate';
import axios from "axios";
import moment from "moment";
import WeeklyReport from "./../component/WeeklyReport.vue"

onMounted(() => {
    const getCase = async () => {
            try {
                const resp = await axios.get('http://127.0.0.1:8000/api/radiusCase');
                // this.cases = resp.data;
                cases.value = resp.data;
                // console.log(cases.value);
            } catch (err) {
                // Handle Error Here
                console.error(err);
                toast.add({ severity: 'info', summary: "Form Submited", detail: err, life: 3000 });
            }
        };

    getCase();
})

// use toast provider
const toast = useToast();

const { handleSubmit, resetForm } = useForm();

// Option for Case
const { value: selectedCase, errorMessage: errorCase } = useField('case', Yup.object().required())
const cases = ref([
    {id: "1", case: "DB TIME OUT"},
    {id: "2", case: "Item Not Found"}
]);

// Option and validation for plant
const { value: selectedPlant, errorMessage: errorPlant } = useField('plant', Yup.object().required())
selectedPlant.value = {name: null, value: null};
const plants = ref([
    {name: "PLG", value: "PLG"},
    {name: "KRW", value: "KRW"},
]);

// Option and validation for Site
const { value: selectedSite, errorMessage: errorSite } = useField('site', Yup.object().required())
const sites = computed(() => {
    if(selectedPlant.value.name == null) {
        return null;
    }
    return selectedPlant.value.name == "PLG" ? [{name: "GR", value: "GR"},{name: "OFF", value: "OFF"}] : [{name: "GR", value: "GR"}];
});

// Option and validation for plant
const { value: date_case, errorMessage: errorDate } = useField('date', Yup.string().required())

const onSubmit = handleSubmit((values) => {
    axios.post('http://127.0.0.1:8000/api/radiusErrorHistory',{
        case_name: selectedCase.value.case,
        date: moment(date_case.value).format('YYYY-M-D h:mm:ss'),
        site: selectedSite.value.name,
        plant: selectedPlant.value.name
    })
    .then(function (response) {
        resetForm();
        selectedPlant.value = [{name: null, value: null}];
        toast.add({ severity: 'info', summary: "Form Submited", detail: response.data.message, life: 3000 });
        // console.log(response.data);
    })
    .catch(function (error) {
        console.log(error);
    });
});
</script>

<style>
.p-datepicker {
    min-width: 430px !important;
    z-index: 99999;
    transform: translateY(90px);
}
</style>
