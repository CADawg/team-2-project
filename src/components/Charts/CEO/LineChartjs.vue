<template>
    <div class="chart-container"><canvas id="dolla-chart"></canvas></div>
</template>

<script>
import Chart from 'chart.js';
import dollaChart from './chart';
export default {
  data() {
        return {
             dollaChart: dollaChart,
        }
    },
    mounted() {
        this.createChart('dolla-chart', this.dollaChart);
    },
    methods: {
        createChart(chartId, chartData) {
            const ctx = document.getElementById(chartId);
            const myChart = new Chart(ctx, {
            type: chartData.type,
            data: chartData.data,
            options: chartData.options,
            });
        }
    }
}
</script>

<style>
    #dolla-chart{
        background: #383d3b;
    }
    canvas{
        width:980px !important;
        height:500px !important;
    }
    @media (max-width: 800px){
        canvas{
            width:710px !important;
            height:400px !important;
        }
    }

</style>
