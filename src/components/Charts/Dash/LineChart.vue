<template>
  <div :class="className" :style="{ height: height, width: width }" />
</template>

<script>
import echarts from "echarts";

require("echarts/theme/macarons"); // echarts theme

export default {
  props: {
    className: {
      type: String,
      default: "chartLine"
    },
    width: {
      type: String,
      default: "100%"
    },
    height: {
      type: String,
      default: "350px"
    },
    autoResize: {
      type: Boolean,
      default: true
    }
  },
  data() {
    return {
      chart: null,
      chartData: {
        edata: [2, 3, 4, 2, 6, 11, 1],
        adata: [5, 6, 8, 1, 9, 3, 2]
      }
    };
  },
  watch: {
    chartData: {
      deep: true,
      handler(val) {
        this.setOptions(val);
      }
    }
  },
  mounted() {
    this.$nextTick(() => {
      this.initChart();
    });
  },
  beforeDestroy() {
    if (!this.chart) {
      return;
    }
    this.chart.dispose();
    this.chart = null;
  },
  methods: {
    initChart() {
      this.chart = echarts.init(this.$el, "macarons");
      this.setOptions(this.chartData);
    },
    setOptions({ expectedData, actualData } = {}) {
      this.chart.setOption({
        xAxis: {
          data: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
          boundaryGap: false,
          axisTick: {
            show: false
          }
        },
        label: {
          textStyle: {
            color: "rgba(255, 255, 255, 0.3)"
          }
        },
        grid: {
          left: 10,
          right: 10,
          bottom: 20,
          top: 30,
          containLabel: true
        },
        textStyle: {
          color: "rgba(255, 255, 255, 0.3)"
        },
        tooltip: {
          trigger: "axis",
          axisPointer: {
            type: "cross"
          },
          padding: [5, 10]
        },
        yAxis: {
          axisTick: {
            show: false
          }
        },
        legend: {
          data: ["expected", "actual"]
        },
        series: [
          {
            name: "expected",
            itemStyle: {
              normal: {
                color: "#54D8FF",
                lineStyle: {
                  color: "#54D8FF",
                  width: 2
                }
              }
            },
            smooth: true,
            type: "line",
            data: this.chartData.edata,
            animationDuration: 2800,
            animationEasing: "cubicInOut"
          },
          {
            name: "actual",
            smooth: true,
            type: "line",
            itemStyle: {
              normal: {
                color: "#A7A7FF",
                lineStyle: {
                  color: "#A7A7FF",
                  width: 2
                },
                areaStyle: {
                  color: "rgba(167,167,255, 0.3)"
                }
              }
            },
            data: this.chartData.adata,
            animationDuration: 2800,
            animationEasing: "quadraticOut"
          }
        ]
      });
    }
  }
};
</script>

<style>
.chartLine {
  background: #383d3b;
}
</style>
