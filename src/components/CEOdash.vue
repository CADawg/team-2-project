<template>
    <div class="CEOdash">
        <h1>Welcome to the CEO</h1>
        <BoxGrid class="boxs"/>
        <GaugeCharts class="boxs"/>
        <LineChartjs/>
        <div class="bottomGrid2">
            <ActiveProjects class="bottomItem"/>
            <ToDo class="toDo bottomItem"/>
        </div>
    </div>
</template>

<script>
import BoxGrid from './Charts/CEO/BoxGrid'
import ActiveProjects from './Charts/CEO/ActiveProjects'
import LineChartjs from './Charts/CEO/LineChartjs'
import GaugeCharts from './Charts/CEO/GaugeCharts'
import ToDo from './TodoList/index'
export default {
    name: 'CEOdash',
    data(){
        return{

        }
    },
    components: {
        BoxGrid,
        ActiveProjects,
        GaugeCharts,
        ToDo,
        LineChartjs
    },
    created(){

    }
}
</script>

<style >
    .CEOdash{
        width: 90%
    }
    .CEOdash .boxs{
        padding-bottom: 50px;

    }
    .bottomGrid2{
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-top: 40px;
    }
    .toDo{
        margin-left: 16%;
    }
    @media (max-width: 800px) {

    }
</style>