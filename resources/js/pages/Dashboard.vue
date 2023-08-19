<template>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <!-- <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ count_pc_krw }}</h3>

                            <p>Computer</p>
                        </div>
                        <div class="icon">
                            <i class="ion" style="color:white; font-family: sans-serif;">
                                KRW
                            </i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ count_pc_plg }}</h3>

                            <p>Computer</p>
                        </div>
                        <div class="icon">
                            <i class="ion" style="color:white; font-family: sans-serif;">
                                PLG
                            </i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div> -->

            <div class="row">
                <!-- <div class="col-12"><h2>kocak</h2></div> -->
                <div class="col-12">
                    <!-- <Dropdown v-model="selectedPlant" :options="plants" optionLabel="name" placeholder="Select a Plant" v-on:change="testchange"/> -->
                    <DataTable
                        :value="computers"
                        ref="dt"
                        stripedRows
                        :paginator="true"
                        :rows="8"
                        :rowsPerPageOptions="[5,10,25,50]"
                        currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
                        paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
                        responsiveLayout="scroll"
                        :globalFilterFields="['id_user_has_computer', 'name','section','pc_name','processor','os','ram', 'hdd', 'ip', 'location']"
                        v-model:filters="filters"
                        removableSort
                        >
                        <template #empty>
                            No computers found.
                        </template>
                        <template #header>
                            <div style="text-align: left">
                                <Button icon="pi pi-external-link" label="Export" @click="exportCSV($event)" />
                                    <span class="p-input-icon-left mx-2">
                                        <i class="pi pi-search" />
                                        <InputText v-model="filters['global'].value" placeholder="Global Search" />
                                    </span>
                            </div>
                        </template>
                        <!-- <Column field="pc_name" header="pc_name" style="min-width:12rem">
                            <template #body="{data}">
                                {{data.pc_name}}
                            </template>
                            <template #filter="{filterModel,filterCallback}">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" :placeholder="`Search by name - `" v-tooltip.top.focus="'Hit enter key to filter'"/>
                            </template>
                        </Column> -->
                        <!-- <Column v-for="(col, index) of selectedColumns" :field="col.field" :header="col.header" :key="col.field + '_' + index"></Column> -->
                        <!-- <Column field="code" header="Code" /> -->

                        <!-- <Column v-for="col of columns" :field="col.field" :header="col.header" :key="col.field"></Column> -->
                        <Column :sortable="true" field="id_user_has_computer" header="ID"></Column>
                        <Column :sortable="true" field="name" header="NAME"></Column>
                        <Column :sortable="true" field="section" header="Section"></Column>
                        <Column field="pc_name" header="PC Name" :sortable="true">
                            <template #filter>
                                <InputText type="text" v-model="filters['name']" class="p-column-filter" placeholder="Search by name"/>
                            </template>
                        </Column>
                        <Column :sortable="true" field="processor" header="Processor">
                            <template #body="{data}">
                                {{ decodeHtml(data.processor) }}
                            </template>
                        </Column>
                        <Column :sortable="true" field="os" header="OS"></Column>
                        <Column :sortable="true" field="ram" header="RAM"></Column>
                        <Column :sortable="true" field="hdd" header="HDD"></Column>
                        <Column :sortable="true" field="ip" header="IP"></Column>
                        <Column :sortable="true" field="location" header="LOCATION"></Column>

                        <Column header="Action" field="id_user_has_computer" header-style="width: 4rem; text-align: center" body-style="text-align: center; overflow: visible">
                            <template #body="{data}">
                                <Button label="Edit" class="p-button-warning p-button-sm" @click="showForm(event, data.id_user_has_computer)" :data-user_computers="data.id_user_has_computer"/>
                                <Button label="Delete" class="p-button-danger p-button-sm" />
                            </template>
                        </Column>
                    </DataTable>
                </div>

                <!-- coba coba dialog - boleh apus -->
                <!-- <div class="col-12">
                    <div class="card flex justify-content-center">
                        <Button label="Show" icon="pi pi-external-link" @click="visible = true" />

                    </div>
                </div> -->
                <!-- end coba coba -->
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <div class="card flex justify-content-center">
        <Button label="Select a Product" icon="pi pi-search" @click="showForm" />
        <Toast />
        <DynamicDialog />
    </div>
    <!-- /.content -->
</template>

<script>
import axios from 'axios'
import { computed } from "vue";
import {FilterMatchMode,FilterOperator} from 'primevue/api';
// import CardFormUser from "../component/CardFormUser.vue";
import CardFormUser from "../modules/stockOpname/component/CardFormUser.vue";
import {validationData} from "../modules/stockOpname/assets/validationData.js"
import {userData} from "../modules/stockOpname/assets/userData.js"
import UpdateStockOpname from '../modules/stockOpname/pages/updateStockOpname.vue';


export default {
    components: {CardFormUser, UpdateStockOpname},
    provide() {
        return {
            errors: computed(() => this.errors),
            validation: computed(() => this.validation),
            users: computed(() => this.user),
        }
    },
    data() {
        return {
            ...userData,
            ...validationData,
            name: "a",
            visible: false,
            selectedPlant : {name: 'ALL', code:'ALL'},
            plants: [
                {name: 'ALL', code: 'ALL'},
                {name: 'PLG', code: 'PLG'},
                {name: 'KRW', code: 'KRW'},
            ],
            errors: {
                name: [false, 'Username is not available.'],
                email: [false, 'Username is not available.'],
                section: [false, 'Username is not available.'],
                factory: [false, 'Username is not available.'],
            },
            count_pc_plg : 0,
            count_pc_krw : 0,
            computers: null,
            selectedColumns: null,
            columns: null,
            filters: {
                'global': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'location': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'pc_name': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'processor': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'os': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'ram': {value: null, matchMode: FilterMatchMode.IN},
                'hdd': {value: null, matchMode: FilterMatchMode.EQUALS},
                'ip': {value: null, matchMode: FilterMatchMode.EQUALS},
            },
            test: [
                    {
                        "id": 1,
                        "pc_name": "nine",
                        "processor": "Intel &reg; Core&trade; i3-6100 Processor",
                        "os": "Windows 10 Pro 64bit",
                        "ram": "8",
                        "hdd": "500",
                        "ip": "172.16.129.240",
                        "ms_office": "Microsoft Office 2007",
                        "antivirus": "Trend Micro|Morpisec",
                        "wsus": "1",
                        "user_login": "harun_rasyid",
                        "brand": "Rakitan",
                        "usage_type": "Alone",
                        "location": "KRW",
                        "date_fa": null,
                        "no_fa": null,
                        "edp_no_fa": null,
                        "keterangan": null,
                        "created_at": "2022-11-11 05:57:04",
                        "updated_at": "2022-11-11 06:03:00",
                        "id_user": 1,
                        "id_computer": 1,
                        "name": "Harun Al Rasyid",
                        "section": "EDP"
                    }
                ]
        }
    },
    mounted() {
        let that = this
        axios.get('/api/computer/getComputerPlant/site/ALL')
            .then(function (response) {
                console.log(response.data.data)
                that.computers = response.data.data
                console.log(that.computers)
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    },
    created() {
        // this.columns = [
        //     {field: 'pc_name', header: 'PC NAME'},
        //     {field: 'processor', header: 'Processor'},
        //     {field: 'os', header: 'Os'},
        //     {field: 'ram', header: 'RAM'},
        //     {field: 'hdd', header: 'HDD'},
        //     {field: 'ip', header: 'IP'},
        //     {field: 'location', header: 'Location'}
        // ];
        // this.selectedColumns = this.columns;
        let that = this
        axios.get('/api/computer/getComputerPlant/site')
            .then(function (response) {
                // handle success
                that.count_pc_krw = response.data.krw
                that.count_pc_plg = response.data.plg
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
    },
    methods: {
        showForm(event, id) {
            const dialogRef = this.$dialog.open(UpdateStockOpname, {
                data: {
                    kocak: id
                },
                props: {
                    header: 'Product List',
                    style: {
                        width: '50vw'
                    },
                    breakpoints: {
                        '960px': '75vw',
                        '640px': '90vw'
                    },
                    modal: true
                },
                templates: {
                    // footer: markRaw(FooterDemo)
                },
                onClose: (options) => {
                    const data = options.data;
                    console.log("kocak ditutup")

                    if (data) {
                        const buttonType = data.buttonType;
                        const summary_and_detail = buttonType ? { summary: 'No Product Selected', detail: `Pressed '${buttonType}' button` } : { summary: 'Product Selected', detail: data.name };

                        this.$toast.add({ severity: 'info', ...summary_and_detail, life: 3000 });
                    }
                }
            });
        },


        decodeHtml(html) {
            var txt = document.createElement("textarea");
            txt.innerHTML = html;
            return txt.value;
        },
        testchange(el) {
            let val = el.value.name
            // this.computers = this.test
            let that = this
            axios.get('/api/computer/getComputerPlant/site/' + val)
            .then(function (response) {
                console.log(response.data.data)
                console.log(that.computers)
                that.computers = response.data.data
            })
            .catch(function (error) {
                // handle error
                console.log(error);
            })
            .then(function () {
                // always executed
            });
        },
        edit(pc_name) {
            console.log("pc namenya adalah : ", pc_name)
        },
        exportCSV() {
            console.log("safasfsaf");
            this.$refs.dt.exportCSV();
        },
        onToggle(value) {
            this.selectedColumns = this.columns.filter(col => value.includes(col));
        }
    }
}
</script>
