<template>
    <Card>
        <template #header>
            <Button icon="pi pi-refresh" class="ml-2 mt-2"  aria-label="Refresh" size="small" @click="bi" />
        </template>
        <template #content>
            <Chart
            type="bar"
            :data="chartData"
            :options="chartOptions"
            class="h-30rem"
            />
        </template>
    </Card>

</template>

<script setup>
import { ref, onMounted } from 'vue';
import { collect } from "collect.js"
import chroma from "chroma-js";
import { scaleThreshold } from 'd3-scale';

function palette(min, max) {
    const d = (max-min)/4;
    return scaleThreshold()
    .domain([min + d*1,min + d*2,min + d*3])
    .range(['#00429d', '#96ffea', '#ff9688', '#005966']);
}

let l = palette(0, 100);
let getData = null;
let dataFinal = null;
let finalDatase

onMounted(() => {
    let finalDataSet = collect();
    let j = chroma.scale(['red', 'green', 'blue']).domain([0,100]);

    dataFinal = collect([]);
    finalDatase = null;

    const generateDataSet = (data) => {
        let a = collect(data).groupBy('case_name')
        let jumlah = 1;
        a.each((item, key) => {
            dataFinal.push({
                label: key,
                data: [item.count()],
                backgroundColor: l(20*jumlah),
                borderColor: l(20*jumlah),
            })
            if(jumlah == a.count()) {
                jumlah--;
            }
            jumlah++;
        })

        finalDataSet = collect({labels: ["7 Days"], datasets: dataFinal.toArray()}).all();
    }

    getData = async () => {
        try {
            const resp = await axios.get('/api/radiusErrorHistory');
            // this.cases = resp.data;
            // dataCase.value = ;
            generateDataSet(resp.data)
            // console.log(finalDataSet);

            // chartData.value = setChartData();
            chartData.value = finalDataSet;
            chartOptions.value = setChartOptions();

            // chartData.value = setChartData();

            // console.log(dataCase.value)
            // console.log(cases.value);
        } catch (err) {
            // Handle Error Here
            console.error(err);
        }

        // console.log("ahahaha")
    };
    getData();
});

const bi = () => {
    chartData.value = null;
    chartOptions.value = null;
    dataFinal = collect([]);
    console.log("asfasf");
    getData();
};

const dataCase = ref();

const chartData = ref();
const chartOptions = ref();

const setChartData = () => {
    const documentStyle = getComputedStyle(document.documentElement);

    return {
        labels: ['25-04-2023 s/d 2-5-2023 | 7 Days'],
        datasets: [
            {
                label: 'Database Time Out',
                backgroundColor: '#4fbac2',
                borderColor: '#4fbac2',
                data: [65],
            },
            {
                label: 'WIP Not Found',
                backgroundColor: documentStyle.getPropertyValue('--pink-500'),
                borderColor: documentStyle.getPropertyValue('--pink-500'),
                data: [28],
            },
            {
                label: 'Inventory Not Found',
                backgroundColor: documentStyle.getPropertyValue('--green-500'),
                borderColor: documentStyle.getPropertyValue('--green-500'),
                data: [78],
            },
        ],
    };
};
const setChartOptions = () => {
    const documentStyle = getComputedStyle(document.documentElement);
    const textColor = documentStyle.getPropertyValue('--text-color');
    const textColorSecondary = documentStyle.getPropertyValue('--text-color-secondary');
    const surfaceBorder = documentStyle.getPropertyValue('--surface-border');

    return {
        maintainAspectRatio: false,
        aspectRatio: 0.8,
        plugins: {
            legend: {
                labels: {
                    fontColor: textColor,
                },
            },
        },
        scales: {
            x: {
            ticks: {
                color: textColorSecondary,
                font: {
                    weight: 500,
                },
            },
            grid: {
                display: false,
                drawBorder: false,
            },
        },
        y: {
            ticks: {
                color: textColorSecondary,
            },
            grid: {
                color: surfaceBorder,
                drawBorder: false,
            },
        },
    }
};
};
</script>

<style scoped>
.p-button.p-button-icon-only {
    width: 2rem;
    height: 2rem;
    padding: 0.75rem 0;
}
</style>
