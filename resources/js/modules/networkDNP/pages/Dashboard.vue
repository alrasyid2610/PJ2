<template>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-12">
                    <h3>Dashboard Network <Button icon="pi pi-plus" severity="info" aria-label="Notification" size="small" /> </h3>
                </div>
                <section class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="network">Network Mapping</div>
                        </div>
                        <div class="card-body row">
                            <div class="col-12">
                                <label for="site">Perangkat <sup style="color: red">*</sup></label>
                                <!-- <input-text class="p-inputtext-sm w-100 forn-control" placeholder="No EDP Fix Asset" v-model="case"></input-text> -->
                                <Dropdown v-model="selectedDevice" name="site" :options="perangkatJaringan3" optionLabel="name" @change="pilihPerangkat" placeholder="Select a Device" class="w-full w-100"  />
                            </div>

                            <div class="col-12">
                                <TabView :scrollable="true">
                                    <TabPanel header="Detail Perangkat">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="label">
                                                    <h6>Nama Perangkat</h6>
                                                    <p>{{ detailPerangkat[0].namaPerangkat }}</p>
                                                </div>
                                                <hr>
                                                <div class="label">
                                                    <h6>Type Perangkat</h6>
                                                    <p>{{ detailPerangkat[0].type }}</p>
                                                </div>
                                                <hr>

                                                <div class="label">
                                                    <h6>Brand</h6>
                                                    <p>{{ detailPerangkat[0].attr.brand }}</p>
                                                </div>
                                                <hr>

                                                <div class="label">
                                                    <h6>Lokasi</h6>
                                                    <p>{{ detailPerangkat[0].lokasi }}</p>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </TabPanel>
                                    <TabPanel header="Detail Port">
                                        <DataTable :value="portDetail" tableStyle="min-width: 50rem" scrollable scrollHeight="400px">
                                            <!-- <Column field="idPerangkatTujuan" header="Id"></Column> -->
                                            <!-- <Column field="portTujuan" header="portTujuan"></Column> -->
                                            <!-- <Column field="namaPerangkatTujuan" header="Perangkat Tujuan"></Column> -->
                                            <Column header="Port" field="Port" style="min-width: 0px">
                                                <template #body="{data, index}">
                                                    <p>{{ ++index }}</p>
                                                    <!-- <Tag :value="data.status" :severity="getSeverity(data.status)" /> -->
                                                </template>
                                                <!-- <template #filter="{ filterModel }">
                                                    <Dropdown v-model="filterModel.value" :options="statuses" placeholder="Select One" class="p-column-filter" showClear>
                                                        <template #option="slotProps">
                                                            <Tag :value="slotProps.option" :severity="getSeverity(slotProps.option)" />
                                                        </template>
                                                    </Dropdown>
                                                </template> -->
                                            </Column>
                                            <Column field="namaPerangkatTujuan" header="Perangkat Tujuan"></Column>
                                        </DataTable>
                                    </TabPanel>
                                    <TabPanel header="Detail Network">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="label">
                                                    <h6>Nama Jaringan</h6>
                                                    <p>{{ detailPerangkat[0].namaPerangkat }}</p>
                                                </div>
                                                <hr>
                                            </div>
                                        </div>
                                    </TabPanel>
                                </TabView>
                            </div>

                        </div>
                    </div>
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
import { collect } from "collect.js"
import { lokasiJaringan, perangkatJaringan } from "../assets/data";

const perangkatJaringan3 = ref([]);
const selectedDevice = ref();
const perangkatJaringans = ref(perangkatJaringan);
const detailPerangkat = ref([{
    'attr': {}
}]);
const portDetail = ref({});

onMounted(() => {
    let a = collect(perangkatJaringan.perangkatJaringan).each((item, index) => {
        perangkatJaringan3.value.push({name: item.namaPerangkat, code: item.namaPerangkat})
    });

    axios.get('/api/networkDNP').then((response) => {
        var a = response.data;
        console.log(JSON.parse(a.attrNd).networks);
        // console.log(a.attr.lokasi);
    })
})

const pilihPerangkat = () => {
    let perangkatSelected = selectedDevice.value.name;
    detailPerangkat.value = collect(perangkatJaringan.perangkatJaringan).filter((value, key) => value.namaPerangkat == selectedDevice.value.name).toArray();
    portDetail.value = collect(detailPerangkat.value[0].attr.portDetail).toArray();
    // console.log(detailPerangkat.value[0].attr.portDetail.entiries())
}
</script>

<style scoped>
.label {
    display: flex;
    justify-content: space-between;
    margin-bottom: 0;
}

.label hr {
    margin-top: 0;
    margin-bottom: 2px !important;
}

.label p {
    margin: 0;
}
</style>
