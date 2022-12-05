<template>
    <section class="content">
        <div class="container-fluid">
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <div class="col-12">
                    <h3>List License</h3>
                    <h4 class="mr-2 d-inline-block">{{ mnt }} : {{ detik }}</h4>
                    <Dropdown v-model="timeValue" :options="timeSelected" optionLabel="name" placeholder="Select a Time" />

                </div>
                <section class="col-lg-12 connectedSortable" v-once>
                    <form action="">
                        <card>
                            <template #content>
                                <div class="row">
                                    <div class="col-lg-3 col-12 license"
                                        v-for="license in licenses"
                                        :key="license.id"
                                        >
                                        <div class="card">
                                            <!-- <div class="coard-header">kocak</div> -->
                                            <div class="card-body" :class="[{expired: license.expired}]">
                                                <h5 class="mb-4">{{ license.license_name }}</h5>
                                                <hr class="mb-2">
                                                <p class="m-0"><h6 class="inline-block mb-2">Last Renewal : {{ license.last_renewal }}</h6></p>
                                                <p class="m-0"><h6 class="inline-block mb-2">Expired Date : {{ license.expired_date }}</h6></p>
                                                <p class="m-0"><h6 class="inline-block mb-2">Time License : {{ license.time_renewal_value }} {{ license.time_renewal_code == "Y" ? "Tahun" : license.time_renewal_code == "M" ? "Bulan" : "Hari" }}</h6></p>
                                                <p class="m-0"><h6 class="inline-block mb-2">Sisa Hari : H{{ license.sisa_hari }}</h6></p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-2 card"
                                        v-for="license in licenses"
                                        :key="license.id">
                                        <h5 class="text-center">{{ license.license_name }}</h5>
                                    </div> -->
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
</template>

<style scoped>
.license .card-body {
    background-color: #c4ffd8;
    border: 4px solid #98f5b7;
    border-radius: 5px;
    color: #0e4600d4;
    box-shadow: 5px -8px 13px #f1f1f1;
}

.license .card-body.expired {
    background-color: #feffc4;
    border: 4px solid hsl(46, 82%, 78%);
    animation: 1s shake 2s cubic-bezier(.36,.07,.19,.97) infinite;
}


@keyframes shake {
  10%, 90% {
    transform: translate3d(-1px, 0, 0);
  }

  20%, 80% {
    transform: translate3d(2px, 0, 0);
    /* transform: translate3d(2px, 10px, 0); */
}

30%, 50%, 70% {
    transform: translate3d(-4px, 0, 0);
    /* transform: translate3d(2px, -10px, 0); */
  }

  40%, 60% {
    transform: translate3d(4px, 0, 0);
  }
}
</style>

<script>
import axios from 'axios'

export default {
    data() {
        return {
            menit: '2',
            detik: '00',
            a: 0,
            time: 5 * 60,
            flag: true,
            timeValue: {name: '5 Minute', code: 5},
            timeSelected: [
                // {name: '1 Minute', code: 1},
                // {name: '2 Minute', code: 2},
                // {name: '3 Minute', code: 3},
                {name: '5 Minute', code: 5},
                {name: '10 Minute', code: 10},
            ],

            licenses: null
        }
    },

    computed: {
        mnt() {
            //
            return this.menit
        }
    },

    watch: {
        timeValue() {
            this.time = this.timeValue.code * 60
        },
        detik() {
            if(this.menit == 1 && this.detik == 55) {
                this.menit = 5
            }
        },
    },

    methods: {

    },

    mounted() {
        var that = this
        axios.get('/api/license')
            .then((response) => {
                that.licenses = response.data;
                console.log(that.licenses)
            })

        // const birthday = new Date('August 19, 1975 23:15:30');
        // const birthday = new Date();
        // this.menit = birthday.getMinutes();
        // this.detik = birthday.getSeconds();
        let time = this.menit * 60;
        // console.log(this.menit * 60)
        setInterval(function() {
            updateCount(that);
        }, 1000);

        function updateCount(a) {
            if(a.flag == false) {
                console.log("reset")
                a.flag = true
                a.time = a.timeValue.code * 60;
            }

            if(a.flag) {
                const minute = Math.floor(a.time / 60);
                let seconds =  a.time % 60;

                seconds = seconds< 10 ? '0' + seconds : seconds;
                a.menit = minute
                a.detik = seconds

                if(a.menit == 0 && a.detik == 0) {
                    axios.get('/api/license')
                        .then((response) => {
                            that.licenses = response.data;
                            console.log(that.licenses)
                        })
                    a.flag = false
                }

                a.time--;
            }
            // var time = a.menit * 60;

        }
    },
}
</script>
