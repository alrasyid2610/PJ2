<template>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-12">
                    <h3>Add License</h3>
                </div>
                <section class="col-lg-12 connectedSortable" v-once>
                    <form action="">
                        <card>
                            <template #content>
                                <div class="row">
                                    <div class="col-md-12 col-12">
                                        <label for="license_name">License Name</label>
                                        <input-text class="p-inputtext-sm w-100"  placeholder="License Name" v-model="data_license.license_name"></input-text>
                                        <small id="username2-help" class="p-error"> </small>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <label for="license_name">Last Renewal</label>
                                        <input type="date" class="form-control" v-model="data_license.last_renewal">
                                        <small id="username2-help" class="p-error"></small>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <label for="license_name">Time for Renewal</label>
                                        <Dropdown v-model="timeValue" :options="timeSelected" optionLabel="name" placeholder="Select a Time" class="w-100" />
                                        <small id="username2-help" class="p-error"> </small>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <label for="license_name">Estimate Expired</label>
                                        <input type="date" class="form-control" v-model="expiredTime" readonly>
                                        <small id="username2-help" class="p-error"></small>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <!-- <Button label="Submit" @click="a"/> -->
                                        <Button label="Submit" @click="submit"/>
                                    </div>
                                </div>
                            </template>
                        </card>
                    </form>
                </section>
            <!-- /.Left col -->
            </div>

            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <Toast position="bottom-right" />
</template>

<script>
import moment from 'moment'
import axios from 'axios';


export default {
    data() {
        return {
            data_license:{
                license_name: null,
                last_renewal: null,
                time_renewal_code: null,
                time_renewal_value: null,
                expired_date: null,
                history: null,
                description: null
            },
            expiredTime: null,
            license_name : null,
            timeValue: null,
            timeSelected: [
                {name: '1 Tahun', code: {code: 'Y', value: 1}},
                {name: '6 Bulan', code: {code: 'M', value: 6}},
                {name: '3 Bulan', code: {code: 'M', value: 3}},

            ]
        }
    },

    computed: {
        expiredTime() {
            if(this.timeValue != null) {
                var code = this.timeValue.code.code
                var value = this.timeValue.code.value
                this.data_license.time_renewal_code = code
                this.data_license.time_renewal_value = value
                console.log(value)
                let expired = moment(this.data_license.last_renewal).add(value, code).format('YYYY-MM-DD');
                this.data_license.expired_date = expired
                return expired
            }
        }
    },

    methods: {
        submit() {
            var that = this
            axios.post('/api/license/', {
                data: that.data_license
            })
            .then((response) => {
                that.$toast.add({severity:'success', summary: 'Success', detail: response.data.message, life: 3000});
                that.data_license = {
                    license_name: null,
                    last_renewal: null,
                    time_renewal_code: null,
                    time_renewal_value: null,
                    expired_date: null,
                    history: null,
                    description: null
                }
                that.timeValue = null
            }).catch((error) => {
                that.$toast.add({severity:'error', summary: 'Error', detail: error.response.data.message, life: 3000});
                console.log(error.response.data.message)
            })
        }
    }
}
</script>
