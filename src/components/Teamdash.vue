<template>
    <div class="CEOdash">
        <h1>Welcome Team Leader</h1>
        <BoxGrid class="boxs"/>
        <div class="bottomGrid">
            <ActiveProjects/>
            <ToDo class="toDo"/>
        </div>
        <h2>Team hours over the last week</h2>
        <HourGraph/>
    </div>
</template>

<script>
import BoxGrid from './Charts/Team/BoxGrid'
import ActiveProjects from './Charts/Team/ActiveProjects'
import ToDo from './TodoList/index'
import HourGraph from './Charts/Team/HourGraph'
export default {
    name: 'CEOdash',
    data(){
        return{

        }
    },
    components: {
        BoxGrid,
        ActiveProjects,
        ToDo,
        HourGraph
    },
    created(){

    }
}
</script>

<style>
    .bottomGrid{
        padding-bottom: 60px;
    }
</style>