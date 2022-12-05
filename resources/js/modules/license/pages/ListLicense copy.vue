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


<script>
import axios from 'axios'

export default {
    data() {
        return {
            menit: '2',
            detik: '00',
            a: 0,
            time: 1 * 60,
            flag: true,
            timeValue: {name: '1 Minute', code: 1},
            timeSelected: [
                {name: '1 Minute', code: 1},
                {name: '2 Minute', code: 2},
                {name: '3 Minute', code: 3},
            ]
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

    mounted() {
        // axios.get('/api/license')
        //     .then((response) => {
        //         console.log(response);
        //     })

        // const birthday = new Date('August 19, 1975 23:15:30');
        // const birthday = new Date();
        // this.menit = birthday.getMinutes();
        // this.detik = birthday.getSeconds();
        let time = this.menit * 60;
        // console.log(this.menit * 60)
        var that = this
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
                            console.log(response.data);
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
