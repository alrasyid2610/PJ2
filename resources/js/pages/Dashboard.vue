<template>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
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
                    <!-- small box -->
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
            </div>

            <div class="row">
                <div class="col-12">
                    <DataTable
                        :value="computers"
                        ref="dt"
                        stripedRows
                        :paginator="true"
                        :rows="5"
                        :rowsPerPageOptions="[5,10,25,50]"
                        currentPageReportTemplate="Showing {first} to {last} of {totalRecords}"
                        paginatorTemplate="CurrentPageReport FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink RowsPerPageDropdown"
                        responsiveLayout="scroll"
                        :globalFilterFields="['pc_name','processor','os','ram', 'hdd', 'ip']"
                        >
                        <template #header>
                            <div style="text-align: left">
                                <Button icon="pi pi-external-link" label="Export" @click="exportCSV($event)" />
                                <MultiSelect class="mx-2" :modelValue="selectedColumns" :options="columns" optionLabel="header" @update:modelValue="onToggle"
                                    placeholder="Select Columns" style="width: 20em"/>
                            </div>
                        </template>
                        <Column field="pc_name" header="pc_name" style="min-width:12rem">
                            <template #body="{data}">
                                {{data.pc_name}}
                            </template>
                            <template #filter="{filterModel,filterCallback}">
                                <InputText type="text" v-model="filterModel.value" @keydown.enter="filterCallback()" class="p-column-filter" :placeholder="`Search by name - `" v-tooltip.top.focus="'Hit enter key to filter'"/>
                            </template>
                        </Column>
                        <Column v-for="(col, index) of selectedColumns" :field="col.field" :header="col.header" :key="col.field + '_' + index"></Column>
                        <!-- <Column field="code" header="Code" /> -->

                        <!-- <Column v-for="col of columns" :field="col.field" :header="col.header" :key="col.field"></Column> -->
                        <!-- <Column field="pc_name" header="PC Name"></Column>
                        <Column field="processor" header="Processor"></Column>
                        <Column field="os" header="OS"></Column>
                        <Column field="ram" header="RAM"></Column>
                        <Column field="hdd" header="HDD"></Column>
                        <Column field="ip" header="IP"></Column>
                        <Column field="location" header="LOCATION"></Column> -->

                        <Column header="Action" header-style="width: 4rem; text-align: center" body-style="text-align: center; overflow: visible">
                            <template #body>
                                <!-- <Button label="Edit" class="p-button-warning p-button-sm" @click="edit(computers.)" /> -->
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</template>

<script>
import axios from 'axios'
import {FilterMatchMode,FilterOperator} from 'primevue/api';
export default {
    data() {
        return {
            count_pc_plg : 0,
            count_pc_krw : 0,
            computers: null,
            selectedColumns: null,
            columns: null,
            filters2: {
                'pc_name': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'processor': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'os': {value: null, matchMode: FilterMatchMode.CONTAINS},
                'ram': {value: null, matchMode: FilterMatchMode.IN},
                'hdd': {value: null, matchMode: FilterMatchMode.EQUALS},
                'ip': {value: null, matchMode: FilterMatchMode.EQUALS}
            },
        }
    },
    mounted() {
        let that = this
        axios.get('/api/computer/getComputerPlant/site/all')
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
        this.columns = [
            {field: 'pc_name', header: 'PC NAME'},
            {field: 'processor', header: 'Processor'},
            {field: 'os', header: 'Os'},
            {field: 'ram', header: 'RAM'},
            {field: 'hdd', header: 'HDD'},
            {field: 'ip', header: 'IP'},
            {field: 'location', header: 'Location'}
        ];
        this.selectedColumns = this.columns;
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
