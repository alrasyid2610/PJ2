<template>
    <!-- <h2>{{ casePerDay }}</h2> -->
    <Card>
        <template #header>
            <div class="flex justify-content-between">
                <h4 class="pt-3 pl-3">Summary</h4>
                <div class="pt-3 pr-3">
                    <Button icon="pi pi-refresh"   aria-label="Refresh" size="small" />
                </div>
            </div>
            <div class="pl-3">
                <Calendar @hide="test" v-model="dates" selectionMode="range" :manualInput="false" />
                {{ datesa }}
            </div>
        </template>
        <template #content>
            <div v-if="casePerDay.length > 0 ? true : false" class="row">
                <div class="col-12">
                    PLG
                </div>
                <div class="col-lg-4 col-md-6 col-12 mt-3 md:mt-0" v-for="caseItem in casePerDay" :key="caseItem.case_name">
                    <div class="box">
                        <div class="number">
                            {{ caseItem.jumlah }}
                        </div>
                        <h4>{{ caseItem.case_name }}</h4>
                    </div>
                </div>
            </div>
            <div class="col-12" v-else>
                <div class="alert alert-primary w-100" role="alert">
                    Tidak ada data hari ini.
                </div>
            </div>
        </template>
    </Card>

</template>

<script setup>
import axios from "axios";
import collect from 'collect.js';
import moment from 'moment';
import { ref, onMounted, computed } from "vue";

const dataSummary = ref();

function test() {
    // console.log(dates.value[0] >= (new Date('2023-05-11 01:53:04')));
    // console.log();
    const a = dataSummary.value.filter((val, key) => {
        // console.log(val.date)
        if( new Date(val.date) >= dates.value[0] && new Date(val.date) <= dates.value[1]) {
            return val
        }
    });

    console.log(a.groupBy('case_name'));
}

const getData = onMounted(() => {
    axios.get('/api/radiusErrorHistory')
        .then((response) => {
            let data = collect(response.data);
            dataSummary.value = data;
            let dataByPlant = data.groupBy('plant');
            let dataByCase = data.groupBy('case_name');
            dataByCase.each((item, key) => {
                console.log(key + ' ' + item.count());
            });
        }).catch((error) => {

        });
});


const selectedPlant = ref({})
const plant = [
    {name: 'ALL', code: 'ALL'},
    {name: 'PG', code: 'PG'},
    {name: 'KRW', code: 'KRW'},
]

const dates = ref();
const datesa = computed(() => {
    return dates;
});

const props = defineProps({
  casePerDay: {},
  titleName: ''
});

const cases = ref('');
</script>

<style scoped>
.p-button.p-button-icon-only {
    width: 2rem;
    height: 2rem;
    padding: 0.75rem 0;
}

.box {
    background-color: #C5F8EB;
    padding: 0;
    border-radius: 4px;
    padding: 30px 0;
    color: #650000;
    box-shadow: -3px 4px 8px #b1b1b173;
}

.box h4 {
    font-size: 1rem;
    text-align: center;
    text-transform: capitalize;
    margin: 0;
    margin-top: 20px;
    font-weight: bold;
}

.box .number {
    text-align: center;
    font-size: 2rem;
}
</style>
