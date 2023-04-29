<template>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-12">
                    <h3>Radius Histories  {{ namaBarang }} <Button icon="pi pi-plus" severity="info" aria-label="Notification" size="small" @click="hilang = !hilang" /> </h3>
                </div>
                <section class="col-lg-4" v-once>
                        <Form @submit="onSubmit">
                            <card>
                                <template #content>

                                    <div class="form-group">
                                        <label for="case">Case <sup style="color: red">*</sup></label>
                                        <!-- <input-text class="p-inputtext-sm w-100 forn-control" placeholder="No EDP Fix Asset" v-model="case"></input-text> -->
                                        <Dropdown v-model="selectedCase" name="case" :options="cases" optionLabel="case" placeholder="Select a City" class="w-full w-100" :class="{ 'p-invalid': errorCase }" required />
                                        <small id="username2-help" class="p-error" v-if="errorCase">{{ errorCase || '&nbsp;' }}</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="plant">Plant <sup style="color: red">*</sup> </label>
                                        <!-- <input-text class="p-inputtext-sm w-100 forn-control" placeholder="No EDP Fix Asset" v-model="case"></input-text> -->
                                        <Dropdown v-model="selectedPlant" :options="plants" optionLabel="name" placeholder="Select a Plant" class="w-full w-100" :class="{ 'p-invalid': errorPlant }" />
                                        <small id="username2-help" class="p-error" v-if="errorPlant">{{ errorPlant || '&nbsp;' }}</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="site">Site <sup style="color: red">*</sup></label>
                                        <!-- <input-text class="p-inputtext-sm w-100 forn-control" placeholder="No EDP Fix Asset" v-model="case"></input-text> -->
                                        <Dropdown v-model="selectedSite" name="site" :options="sites" optionLabel="name" placeholder="Select a Site" class="w-full w-100" :class="{ 'p-invalid': errorSite }" />
                                        <small id="username2-help" v-if="selectedSite == null ? true : false">Pilih Plant terlebih dahulu</small>
                                        <small id="username2-help" class="p-error" v-if="errorSite">{{ errorSite || '&nbsp;' }}</small>
                                    </div>

                                    <div class="form-group">
                                        <Field name="mesin" v-slot="{ field, errorMessage }" :rules="mesinRules" v-if="selectedCase2 != 'Database Time Out' ? false : true">
                                            <label for="mesin">Mesin</label>
                                            <input-text v-bind="field" class="p-inputtext-sm w-100" placeholder="Masukan Mesin" name="mesin" :class="{ 'p-invalid': errorMessage }"></input-text>
                                            <ErrorMessage as="div" name="mesin" v-slot="{ message }">
                                                <small class="p-error">{{ message }}</small>
                                            </ErrorMessage>
                                        </Field>
                                    </div>

                                    <div class="form-group">
                                        <Field name="inque" v-slot="{ field, errorMessage }" :rules="Yup.number().required()" v-if="selectedCase2 != 'Database Time Out' ? false : true">
                                            <label for="inque">Inque</label>
                                            <input-text v-bind="field" class="p-inputtext-sm w-100" placeholder="Masukan Inque" name="inque" :class="{ 'p-invalid': errorMessage }"></input-text>
                                            <ErrorMessage as="div" name="inque" v-slot="{ message }">
                                                <small class="p-error">{{ message }}</small>
                                            </ErrorMessage>
                                        </Field>
                                    </div>

                                    <div class="form-group">
                                        <Field name="outque" v-slot="{ field, errorMessage }" :rules="Yup.number().required()" v-if="selectedCase2 != 'Database Time Out' ? false : true">
                                            <label for="outque">Outque</label>
                                            <input-text v-bind="field" class="p-inputtext-sm w-100" placeholder="Masukan Inque" name="inque" :class="{ 'p-invalid': errorMessage }"></input-text>
                                            <ErrorMessage as="div" name="outque" v-slot="{ message }">
                                                <small class="p-error">{{ message }}</small>
                                            </ErrorMessage>
                                        </Field>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tanggal FA <sup style="color: red">*</sup></label>
                                        <!-- <input type="datetime-local" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> -->
                                        <Calendar showTime showButtonBar hourFormat="24" class="w-100" v-model="date_case" name="date" :class="{ 'p-invalid': errorDate }" />
                                        <small id="username2-help" class="p-error" v-if="errorDate">{{ errorDate || '&nbsp;' }}</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="site">Human Error</label>
                                        <div>
                                            <InputSwitch v-model="humanError" name="human_error"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="site">Keterangan</label>
                                        <div>
                                            <Textarea v-model="keterangan" rows="3" class="w-100" name="keterangan"/>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <Button label="Submit" type="submit"/>
                                    </div>
                                </template>
                            </card>
                        </Form>
                </section>
                <section class="col-lg-8 mt-4 md:mt-0">
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
import { useField, useForm, Field, ErrorMessage} from 'vee-validate';
import axios from "axios";
import moment from "moment";
import WeeklyReport from "./../component/WeeklyReport.vue"

const namaBarang = ref('');
const hilang = ref(false);

onMounted(() => {
    const getCase = async () => {
            try {
                const resp = await axios.get('/api/radiusCase');
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

    const getCasePerDay = async () => {
        try {
            const resp = await axios.get('/api/getRadiusCase/getCasePerDay');
            // this.cases = resp.data;
            // cases.value = resp.data;
            console.log(resp)
            // console.log(cases.value);
        } catch (err) {
            // Handle Error Here
            console.error(err);
            toast.add({ severity: 'info', summary: "Form Submited", detail: err, life: 3000 });
        }
    }

    getCasePerDay();
})

// use toast provider
const toast = useToast();

const mesinRules = Yup.string().required();

const { handleSubmit, resetForm } = useForm();

// Option for Case
const { value: selectedCase = "asf", errorMessage: errorCase } = useField('case', Yup.object().required())
// selectedCase.value = {id: null, case: null};
const selectedCase2 = computed(() => {
    return selectedCase.value == undefined ? '' : selectedCase.value.case
});
const cases = ref([
    {id: "1", case: "DB TIME OUT"},
    {id: "2", case: "Item Not Found"}
]);

// Option and validation for plant
const { value: selectedPlant, errorMessage: errorPlant } = useField('plant', Yup.object().required())
const selectedPlant2 = computed(() => {
    return selectedPlant.value == undefined ? '' : selectedPlant.value.value
});
const plants = ref([
    {name: "PLG", value: "PLG"},
    {name: "KRW", value: "KRW"},
]);

const { value: humanError } = useField('human_error');
const { value: keterangan } = useField('keterangan');
// const { value: mesin, errorMessage: errorMesin } = useField('mesin');
// const { value: inque, errorMessage: errorInque } = useField('inque');
// const { value: outque, errorMessage: errorOutque } = useField('outque');
humanError.value = false;
keterangan.value = ' ';


// Option and validation for Site
const { value: selectedSite, errorMessage: errorSite } = useField('site', Yup.object().required())
const sites = computed(() => {
    if(selectedPlant2.value == '') {
        return null;
    }
    return selectedPlant2.value == "PLG" ? [{name: "GR", value: "GR"},{name: "OFF", value: "OFF"}] : [{name: "GR", value: "GR"}];
});

// Option and validation for plant
const { value: date_case, errorMessage: errorDate } = useField('date', Yup.string().required())

const onSubmit = handleSubmit((values) => {
    console.log("done");
    // console.log(values.mesin)
    axios.post('/api/radiusErrorHistory',{
        case_name: selectedCase.value.case,
        date: moment(date_case.value).format('YYYY-M-D h:mm:ss'),
        site: selectedSite.value.name,
        plant: selectedPlant.value.name,
        human_error: humanError.value,
        keterangan: keterangan.value,
        mesin: values.mesin,
        inque: values.inque,
        outque: values.outque
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
