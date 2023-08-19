<template>
    <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update Stock Opname {{ id }}</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Input Stock Opname</li>
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
                    <section class="col-lg-12 connectedSortable">
                        <form @submit.prevent="" >
                            <card>
                                <template #content>
                                    <div class="row">
                                        <div class="col-12">
                                            <CardFormUser @submit="submit" :isUpdatePages="true" />
                                        </div>

                                        <div class="col-12">
                                            <CardFormComputer  />
                                        </div>

                                        <!-- <button class="btn btn-primary" @click="test">Submit</button> -->
                                    </div>

                                    <div class="row">
                                        <div class="col-12">
                                            <Button label="Submit" @click="test(user, validation)"/>
                                            {{ validation.name.error }}
                                        </div>
                                    </div>
                                </template>
                            </card>
                        </form>

                        <!-- Custom tabs (Charts with tabs)-->
                        <!-- /.card -->
                    </section>

                    <!-- <div class="col-lg-4 connectedSortable pc_section">
                        <card>
                            <template #content>
                                <h3>Data Last Added</h3>
                                <ul>
                                    <li v-for="computer in data_computers">
                                        <h2>PC Name : {{ computer.pc_name }}</h2>
                                        <h2>IP : {{ computer.ip }}</h2>
                                        <h2>IP : {{ computer.processor }} </h2>
                                    </li>
                                </ul>
                            </template>
                        </card>
                    </div> -->
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
import {computerData} from "../assets/computerData.js"
import {userData} from "../assets/userData.js"
import {sectionArray, factory} from "../assets/userDatabaseData.js";


export default {
    props: ['id'],
    components: { Button, CardFormUser, CardFormComputer },
    provide() {
        return {
            errors: computed(() => this.errors),
            // errors: this.errors,
            users: computed(() => this.user),
            sectionArray: computed(() => this.sectionArray),
            factory: computed(() => this.factory),

            //Data Computer
            computer: computed(() => this.computer),
            validation: computed(() => this.validation),

            submit: computed(() => this.submit)
        }
    },
    data() {
        return {
            ...validationData,
            ...computerData,
            ...userData,
            ...sectionArray,
            user_has_computer: '',
            errors: {
                name: [false, 'Username is not available.'],
                email: [false, 'Username is not available.'],
                section: [false, 'Username is not available.'],
                factory: [false, 'Username is not available.'],
            },
            factory: [
                {name: 'PLG', code: 'PLG'},
                {name: 'KRW', code: 'KRW'},
            ],
            data_computers: null,
        }
    },

    methods: {
        validEmail: function (email) {
            var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            return re.test(email);
        },
        checkForm(users,validationData) {

            users.sectionArray = this.sectionArray.find(el => el.code === users.sectionArray.code);


            // console.log(this.computer.status_fix_asset)
            validationData.name.error = users.name === '' ? true : false
            validationData.section.error = users.sectionArray.name === '' ? true : false
            validationData.factory.error = users.factory === '' ? true : false
            validationData.pc_name.error = this.computer.pc_name === '' ? true : false;
            validationData.processor.error = this.computer.processor === '' ? true : false;
            validationData.os.error = this.computer.os === '' ? true : false;
            validationData.ram.error = this.computer.ram === '' ? true : false;
            validationData.hdd.error = this.computer.hdd === '' ? true : false;
            validationData.ip.error = this.computer.ip === '' ? true : false;
            validationData.ms_office.error = this.computer.ms_office === '' ? true : false;
            validationData.antivirus.error = this.computer.antivirus.length === 0 ? true : false;
            // validationData.wsus.error = this.computer.wsus === false ? true : false;
            validationData.user_login.error = this.computer.user_login === '' ? true : false;
            validationData.brand.error = this.computer.brand === '' ? true : false;
            validationData.usage_type.error = this.computer.usage_type === '' ? true : false;
            // validationData.location.error = this.computer.location.name === '' ? true : false;
            if(this.computer.status_fix_asset.code == true) {
                validationData.date_fa.error = this.computer.date_fa === '' || this.computer.date_fa == null ? true : false;
                validationData.no_fa.error = this.computer.no_fa === '' || this.computer.no_fa == null ? true : false;
                validationData.edp_no_fa.error = this.computer.edp_no_fa === '' || this.computer.edp_no_fa == null ? true : false;

                // console.log('cek fix asset');
                // console.log(this.computer.date_fa);
            } else {
                validationData.date_fa.error = false;
                validationData.no_fa.error = false;
                validationData.edp_no_fa.error = false;
                // console.log('ga usah cek');
            }
            // console.log(this.computer.wsus);
            const a = validationData.email.error = users.email != '' && users.email.length > 0 ? true : false
            if(a) {
                // console.log(this.validEmail(users.email))
                validationData.email.error = !this.validEmail(users.email);
                validationData.email.message = "Email is no Valid";
            }

            // console.log(validationData.email.error);
            // console.log(validationData.name.error);

            if(validationData.email.error || validationData.name.error || validationData.section.error || validationData.factory.error || validationData.pc_name.error || validationData.processor.error || validationData.os.error || validationData.ram.error || validationData.hdd.error || validationData.ip.error || validationData.ms_office.error || validationData.antivirus.error || validationData.wsus.error || validationData.user_login.error || validationData.brand.error || validationData.usage_type.error || validationData.status_fix_asset.error || validationData.date_fa.error || validationData.no_fa.error|| validationData.edp_no_fa.error  ) {
                // console.log("Masih ada error brow");
                this.$toast.add({severity:'error', summary: 'Data input failed', detail:'Check the input again', life: 3000});

            } else {
                this.computer.location = this.user.factory;
                // console.log("siap input");
                // console.log(this.computer);

                // user_has_computer update
                this.user_has_computer.name = this.user.name;
                this.user_has_computer.pc_name = this.computer.pc_name;
                this.user_has_computer.section = this.user.section;
                this.user_has_computer.location = this.user.factory;

                // console.log(this.computer.date_fa);
                users.section = users.sectionArray.name;
                users.id_section = users.sectionArray.code;
                this.submit();
            }
        },
        test(users, validation) {
            this.checkForm(users, validation);
            // console.log(this.users);
        },

        showSuccess() {
            this.$toast.add({severity:'warn', summary: 'Awas ada anjing', detail:'Message Content', life: 100000});
        },
        ubah(a) {
            this.errors.name[1] = a;
        },
        submit() {
            // Make a request for a user with a given ID
            // console.log(this.users.factory.name);
            var that = this;

            console.log("submit");

            // console.log(this.user);
            // console.log(this.computer);

            // console.log(that.users.location.name);

            axios.put('/api/stock-opname/' + this.user_has_computer, {
                user: this.user,
                computer: this.computer,
                user_has_computer: this.user_has_computer
            })
            .then(function (response) {
                console.log(response);
                const data = response.data.data;
                const message = response.data.message;
                const success = response.data.success;
                // console.log(response);


                // not success
                // if(!success) {
                //     that.errors.name[0] = data.name != undefined ? true : false
                //     that.errors.name[1] = data.name != undefined ? data.name[0] : false

                //     that.errors.email[0] = data.email != undefined ? true : false
                //     that.errors.email[1] = data.email != undefined ? data.email[0] : false

                //     that.errors.section[0] = data.section != undefined ? true : false
                //     that.errors.section[1] = data.section != undefined ? data.section[0] : false

                //     that.errors.factory[0] = data.location != undefined ? true : false
                //     that.errors.factory[1] = data.location != undefined ? data.location[0] : false
                //     that.$toast.add({severity:'error', summary: 'Error', detail: message, life: 3000});
                //     // console.log(that.users);
                // } else {
                //     that.errors = {
                //             name: [false, 'Username is not available.'],
                //             email: [false, 'Username is not available.'],
                //             section: [false, 'Username is not available.'],
                //             factory: [false, 'Username is not available.'],
                //         }


                //     that.$toast.add({severity:'success', summary: 'Success', detail: message, life: 3000});
                //     this.getData();

                // }

                that.$toast.add({severity:'success', summary: 'Success', detail: message, life: 3000});
            })
            .catch(function (error) {
                console.log(error);
            });
        },

        getData() {
            // this.id = this.$route.params.id;
            // console.log(this.$route.params);
            var that = this;
            axios.get('/api/stock-opname/' + this.id)
            .then(function (response) {
                var data = response.data;
                // console.log(data);
                that.computer = data[0][0]; // get data computer
                that.user = data[1][0]; // get data user
                that.user.sectionArray = { // serialize section for format
                    name: data[1][0].section,
                    code: data[1][0].id_section.toString(),
                }

                that.user_has_computer= data[2][0]; // get data user_has_computer


                // SERIALIZE ANTIVIRUS FOR DEFAULT VALUE
                if(that.computer.antivirus == null) {
                    that.computer.antivirus = '';
                } else {
                    var antivirus = [
                    ];
                    const antivirusArray = that.computer.antivirus.split("|");
                    antivirusArray.forEach((element, index) => {
                        antivirus[index] = {name: element, code: element}
                    });
                    that.computer.antivirus = antivirus;
                }
                    // SERIALIZE ANTIVIRUS FOR DEFAULT VALUE

                // Serialize WSUS for default value
                that.computer.wsus = !!Number(that.computer.wsus);
                // Serialize WSUS for default value

                // Serialize FIX ASSET for default value
                that.computer.status_fix_asset = that.computer.date_fa == null ? {name: 'Tidak Ada', code: false} : {name: 'Ada', code: true}
                // console.log(that.computer.date_fa);

                // that.computer.status_fix_asset = that.computer.date_fa == null ?
                // console.log(data);
            })
            .catch(function (error) {
                console.log(error);
            });
        }
    },

    created() {
        // console.log(this.users);


        // Echo.channel('messeage')
        //     .listen('ComputerUserCreated', (e) => {
        //         this.data_computers = JSON.parse(e.message);
        //         // console.log(this.data_computers[0]);
        //     });

        const sendGetRequest = async () => {
            try {
                const resp = await axios.get('/api/computer');
                this.data_computers = resp.data;
            } catch (err) {
                // Handle Error Here
                console.error(err);
            }
        };

        sendGetRequest();

        this.$watch(() => this.$route.params, () => {
            // console.log(this.$route.params.id + " afsasf")
            this.getData();


        }, { immediate: true })

        // async function getData() {
        //     const response = await axios.get('/api/computer')
        //         .then((response) => {
        //             console.log(response);
        //         })
        // }
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
