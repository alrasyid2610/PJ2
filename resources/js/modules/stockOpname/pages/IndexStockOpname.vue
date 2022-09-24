<template>
    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Data Stock Opname</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">List Data Stock Opname</li>
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
                                    <div>
                                        <h2 id="kocak">Data</h2>
                                    </div>
                                    <table id="table_id" class="display">
                                        <thead>
                                            <tr>
                                                <th>PC Name</th>
                                                <th>IP</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="computer in computers">
                                                <td>{{ computer.pc_name }}</td>
                                                <td>{{ computer.ip }}</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </template>
                            </card>
                        <!-- Custom tabs (Charts with tabs)-->
                        <!-- /.card -->
                    </section>
                <!-- /.Left col -->
                </div>

                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
</template>

<script>
import axios from 'axios';
import Button from 'primevue/button/Button.vue';
import CardFormUser from "../component/CardFormUser.vue";
import CardFormComputer from "../component/CardFormComputer.vue";
import { computed } from "vue";
import {validationData} from "../assets/validationData.js"

// import "jquery/dist/jquery"
// import "datatables.net/js/jquery.dataTables"
// import $ from "jquery"
// import "datatables.net-dt/js/dataTables.dataTables"
// import "datatables.net-dt/css/jquery.dataTables.min.css"
// import $ from 'jquery';

export default {

    components: { Button, CardFormUser, CardFormComputer },
    provide() {
        return {
        }
    },
    data() {
        return {
            data_computers: null,
        }
    },

    computed: {
        computers() {
            return this.data_computers
        }
    },

    methods: {

    },

    created() {
        Echo.channel('messeage')
            .listen('ComputerUserCreated', (e) => {
                this.data_computers = JSON.parse(e.message);
                console.log(this.data_computers);
            });

        const sendGetRequest = async () => {
            try {
                const resp = await axios.get('http://127.0.0.1:8000/api/computer');
                this.data_computers = resp.data;
            } catch (err) {
                // Handle Error Here
                console.error(err);
            }
        };

        sendGetRequest();

        // async function getData() {
        //     const response = await axios.get('http://127.0.0.1:8000/api/computer')
        //         .then((response) => {
        //             console.log(response);
        //         })
        // }

    },

    mounted() {
        $(document).ready( function () {
            console.log($("#table_id").DataTable({
                    paging: false,
                    searching: true,
            }));
        });
    }
}
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
