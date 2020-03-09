<template>
    <div class="gaugeGrid">
        <div class="Gauges">
            <h3>Team One KPI</h3>
            <VueSpeedometer
                :maxSegmentLabels="12"
                :needleHeightRatio="0.5"
                :segments="3"
                :value="40"
                :minValue="0"
                :maxValue="100"
                :customSegmentStops="[0, 30, 60, 100]"
                :segmentColors='["#FF6060", "#E6A23C", "#67C23A"]'
                needleColor="#383D3B"
                :width = 190
            />
        </div>
        <div class="Gauges">
            <h3>Team Two KPI</h3>
            <VueSpeedometer
                :maxSegmentLabels="12"
                :segments="3"
                :value="10"
                :minValue="0"
                :maxValue="100"
                :customSegmentStops="[0, 30, 60, 100]"
                :segmentColors='["#FF6060", "#E6A23C", "#67C23A"]'
                needleColor="#383D3B"
                :width = 190
            />
        </div>
        <div class="Gauges">
            <h3>Team Three KPI</h3>
            <VueSpeedometer
                :maxSegmentLabels="12"
                :segments="3"
                :value="90"
                :minValue="0"
                :maxValue="100"
                :customSegmentStops="[0, 30, 60, 100]"
                :segmentColors='["#FF6060", "#E6A23C", "#67C23A"]'
                needleColor="#383D3B"
                :width = 190
            />
        </div>
        <div class="Gauges">
            <h3>Team Four KPI</h3>
            <VueSpeedometer
            
                :maxSegmentLabels="12"
                :segments="3"
                :value="80"
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
export default {
    name: "GaugeCharts",
    data() {
        return {}
    },
    components: { VueSpeedometer },

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
            grid-template-columns: 47% 47%;
            grid-gap: 8%
        }
        .Gauges{
             width: 100%;
             text-align: center;
             padding: 0
        }
    }
</style>
