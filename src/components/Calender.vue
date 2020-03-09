<template>
    <div class="Calender">
        <div class="calenderContainer">
            <FullCalendar
                class="demo-app-calendar"
                ref="fullCalendar"
                defaultView="dayGridMonth"
                :header="{
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                }"
                :plugins="calendarPlugins"
                :events="[
                    { title: 'Project Due', date: '2020-03-10' },
                    { title: 'Meeting with Bob', date: '2020-03-01' },
                    { title: 'Golf with John', date: '2020-03-21' },
                    
                ]"
            />
        </div>
    </div>
</template>

<script>
import { Calendar } from "@fullcalendar/core";
import FullCalendar from "@fullcalendar/vue";
import dayGridPlugin from "@fullcalendar/daygrid";
import timeGridPlugin from "@fullcalendar/timegrid";
import listPlugin from "@fullcalendar/list";
import interactionPlugin from "@fullcalendar/interaction";

export default {
    name: "Calender",
    data() {
        return {
            calendarPlugins: [dayGridPlugin, timeGridPlugin, interactionPlugin]
        };
    },
    components: {
        FullCalendar // make the <FullCalendar> tag available
    }
};
</script>

<style lang="scss">
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";
@import "~@fullcalendar/timegrid/main.css";
.calenderContainer {
    margin: 5%;
    padding: 2%;
    background: #4bcad1;
}
.demo-app-calendar {
    background: #eee5e9;
}
.fc-widget-header {
    background: #92dce5;
    padding: 5px;
}
.fc-unthemed td.fc-today {
    background: #92dce5;
}
.fc-button {
    background: #eee5e9;
    border: 1px solid #d7dae2;
    color: black;
    transition: 0.5s;
}
.fc-button:hover,
.fc-button-primary:not(:disabled).fc-button-active:hover {
    background: #f5f5f5;
    transition: 0.5s;
    border: 1px solid #d7dae2;
    color: black;
}
.fc-button-primary:not(:disabled).fc-button-active {
    background: #eee5e9;
    border: 1px solid #d7dae2;
    color: #116466;
}
.fc-toolbar,
.fc-header-toolbar {
    background: #4bcad1;
    padding: 1%;
}

.fc-event {
    background: #383D3B;
    border: 2px solid #383D3B;
}
</style>