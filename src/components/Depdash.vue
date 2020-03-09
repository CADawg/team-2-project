<template>
    <div class="Depdash">
        <h1>Welcome Department head</h1>
        <BoxGrid class="boxs"/>
        <GaugeCharts class="boxs"/>
        <LineChartjs/>
        <div class="bottomGrid">
            <ActiveProjects/>
            <ToDo class="toDo"/>
        </div>
    </div>
</template>

<script>
import BoxGrid from './Charts/Dash/BoxGrid'
import ActiveProjects from './Charts/CEO/ActiveProjects'
import LineChartjs from './Charts/Dash/LineChartjs'
import GaugeCharts from './Charts/Dash/GaugeCharts'
import ToDo from './TodoList/index'
export default {
    name: 'Depdash',
    data(){
        return{

        }
    },
    components: {
        BoxGrid,
        ActiveProjects,
        GaugeCharts,
        LineChartjs,
        ToDo
    },
    created(){

    }
}
</script>

<style>
    .Depdash{
        width: 90%
    }
    .Depdash .boxs{
        padding-bottom: 50px;
    }
    .bottomGrid{
        display: grid;
        grid-template-columns: 1fr 1fr;
        margin-top: 40px;
    }
    .toDo{
        margin-left: 16%;
    }
</style>