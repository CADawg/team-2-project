<template>
    <div class="gaugeGrid">
        <div class="Gauges">
            <h3>Attrition Rate</h3>
            <VueSpeedometer
                :maxSegmentLabels="12"
                :needleHeightRatio="0.5"
                :segments="3"
                :value="attRate"
                :minValue="0"
                :maxValue="100"
                :customSegmentStops="[0, 30, 60, 100]"
                :segmentColors='["#FF6060", "#E6A23C", "#67C23A"]'
                needleColor="#383D3B"
                :width = 190
            />
        </div>
        <div class="Gauges">
            <h3>Client Satisfaction</h3>
            <VueSpeedometer
                :maxSegmentLabels="12"
                :segments="3"
                :value="88"
                :minValue="0"
                :maxValue="100"
                :customSegmentStops="[0, 30, 60, 100]"
                :segmentColors='["#FF6060", "#E6A23C", "#67C23A"]'
                needleColor="#383D3B"
                :width = 190
            />
        </div>
        <div class="Gauges">
            <h3>Monthly Sales Growth </h3>
            <VueSpeedometer
                :maxSegmentLabels="12"
                :segments="3"
                :value="34"
                :minValue="0"
                :maxValue="100"
                :customSegmentStops="[0, 30, 60, 100]"
                :segmentColors='["#FF6060", "#E6A23C", "#67C23A"]'
                needleColor="#383D3B"
                :width = 190
            />
        </div>
        <div class="Gauges">
            <h3>Employee Satisfaction</h3>
            <VueSpeedometer
            
                :maxSegmentLabels="12"
                :segments="3"
                :value="89"
                :minValue="0"
                :maxValue="100"
                :customSegmentStops="[0, 30, 60, 100]"
                :segmentColors='["#FF6060", "#E6A23C", "#67C23A"]'
                needleColor="#383D3B"
                :width = 190
            />
        </div>
    </div>
</template>

<script>
import VueSpeedometer from "vue-speedometer"
import db from '../../../firebase2/init'
export default {
    name: "GaugeCharts",
    data() {
        return {
            currentStaff: null,
            leftStaff: null,
            attRate: 44,
        }
    },
    components: { VueSpeedometer },
    created(){
        //Get attrition rate
        
    }

};
</script>

<style>
    .gaugeGrid{
        display: grid;
        grid-template-columns: 15vw 15vw 15vw 15vw;
        grid-gap: 5vw;
    }
    .Gauges{
        width: 190px;
        text-align: left;
        height: 190px;
        padding: 0 5%;
        background: #4BCAD1;
    }
    @media (max-width: 800px) {
        .gaugeGrid{
            grid-template-columns: 70%;
        }
        .Gauges{
             width: 100%;
        }
    }
</style>
