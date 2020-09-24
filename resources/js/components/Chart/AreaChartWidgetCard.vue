<template>
    <div class="card">
        <div class="card-body">
            <div class=""><i v-bind:class="cardIcon" class="text-white font-33"></i></div>
            <h3 class="mb-0 mt-2">{{readingPrefix}}{{procNewReading}}{{readingSuffix}}</h3>
            <p class="mb-0">{{cardTitle}}</p>
        </div>
        <apexchart height="110" type="area" :options="chartOptions" :series="series"></apexchart>
    </div>
</template>

<script>
    export default {
        props: {
            cardIcon: String,
            newReading: Number,
            readingPrefix: {type: String, default: ''},
            readingSuffix: {type: String, default: ''},
            cardTitle: String,
            seriesValues: Array,
        },
        data: function () {
            let _this = this;
            return {
                chartOptions: {
                    chart: {
                        height: 110,
                        sparkline: {
                            enabled: true
                        }
                    },
                    dataLabels: {
                        enabled: false
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'light',
                            //gradientToColors: ['rgba(255, 255, 255, 0.12)'],
                            shadeIntensity: 1,
                            type: 'vertical',
                            opacityFrom: 0.7,
                            opacityTo: 0.1,
                            stops: [0, 100, 100, 100]
                        },
                    },
                    colors: ["#fff"],
                    stroke: {
                        width: 2.5,
                        curve: 'smooth',
                        dashArray: [0]
                    },
                    tooltip: {
                        theme: 'dark',
                        x: {
                            show: false
                        },

                    }
                },
                series: [{
                    name: _this.cardTitle,
                    data: _this.seriesValues
                }],


            }
        },
        computed: {
            procNewReading() {
                let seriesValue = this.seriesValues;
                if (this.newReading == null || isNaN(this.newReading)) {
                    let arr_count = seriesValue.length;
                    if (arr_count < 1)
                        return 0;
                    return seriesValue[seriesValue.length - 1]
                }
                return this.newReading;
            }
        },
        watch: {
            newReading: {
                handler(newVal) {
                    if (newVal == null)
                        return;
                    this.series[0].data.push(newVal);
                    // this.series[0].data.shift(); //if I decide I want a constant number of values here
                }
            },

            seriesValues: {
                handler(newSeries) {
                    this.series = [{
                        data: newSeries
                    }];
                }
            }
        }
    }
</script>

