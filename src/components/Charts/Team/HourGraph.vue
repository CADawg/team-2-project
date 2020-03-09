<template>
    <div>
        <div class="chart-container"><canvas id="hourChart"></canvas></div>
    </div>
</template>

<script>
//import Chart from 'chart.js';
import hourChart from './chart';
import db from '../../../firebase2/init'
export default {
    name: 'HourGraph',
    data(){
        return{
            hourChart: hourChart,
            hourData: []
        }
    },
    mounted() {
       
        let ref = db.collection("timesheetTest")
        ref.get().then(snapshot => {
            snapshot.forEach(doc => {
                this.hourData.push(
                    doc.data().hours
                )
            })
            console.log(this.hourData)
            this.createChart('hourChart', this.hourChart);
        })
    },
    methods: {
        createChart(chartId, chartData) {
            const ctx = document.getElementById(chartId);
            const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: ['Costa', 'ASOS', 'Spotify'],
            datasets: [
                { 
                label: 'Hours expected',
                data: [15,20,13],
                backgroundColor: [
                    'transparent'
                ],
                borderColor:'#A7A7FF',
                borderWidth: 3
                },
                {
                label: 'Hours worked',
                data: [this.hourData[0], this.hourData[1], this.hourData[2]],
                backgroundColor: [
                    'transparent'
                ],
                borderColor: '#47b784',
                borderWidth: 3
                }
            ]
            },
            options: {
            responsive: true,
            legend: {
                labels: {
                    fontColor: '#EEE5E9'
                }
            },
            lineTension: 1,
            scales: {
                yAxes: [{
                ticks: {
                    beginAtZero: true,
                    padding: 25,
                    fontColor: '#EEE5E9'
                }
                }],
                xAxes: [{
                    ticks: {
                        fontColor: '#EEE5E9'
                    }
                }]
            }
            }
                    });
        },
        addData() {
            myChart.data.datasets[0].data[0] = 70
            //chart.update();
        }
    }
}
</script>

<style>
    #hourChart{
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