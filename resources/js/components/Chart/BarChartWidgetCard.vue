<template>
    <div class="card">
        <div class="card-body">
            <div class="media align-items-center">
                <!--                <div class="card-content dash-array-chart-box">-->
                <!--                    <apexchart height="180" type="radialBar" :options="radChartOptions" :series="[procNewValue]"></apexchart>-->
                <!--                </div>-->
                <div class="card-content dash-array-chart-box">
                    <apexchart width="180" height="120" type="radialBar" :options="radChartOptions"
                               :series="procRadSeries"></apexchart>
                </div>

                <div class="media-body ml-3">
                    <div class=""><i v-bind:class="cardIcon" class="text-white font-33"></i></div>
<!--                    <h5 class="mt-3 mb-0"></h5>-->
                    <p class="mb-0">{{valueTitle}}</p>
                </div>
                <div class="text-right">
                    <apexchart width="200" height="73" type="bar" :options="chartOptions"
                               :series="procSeries"></apexchart>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            cardIcon: String,
            valueTitle: String,
            readingPrefix: {type: String, default: ''},
            readingSuffix: {type: String, default: ''},
            newValue: Number,
            seriesValues: Array,
        },
        data: function () {
            return {
                radChartOptions: {
                    plotOptions: {
                        radialBar: {
                            //startAngle: -135,
                            //endAngle: 135,
                            hollow: {
                                margin: 0,
                                size: '65%',
                                background: 'rgba(0, 0, 0, 0.0)',
                                image: undefined,
                                imageOffsetX: 0,
                                imageOffsetY: 0,
                                position: 'front',
                                dropShadow: {
                                    enabled: true,
                                    top: 3,
                                    left: 0,
                                    blur: 4,
                                    opacity: 0.1
                                }
                            },
                            track: {
                                background: 'rgba(255, 255, 255, 0.12)',
                                strokeWidth: '100%',
                                margin: 0, // margin is in pixels
                                dropShadow: {
                                    enabled: true,
                                    top: -3,
                                    left: 0,
                                    blur: 4,
                                    opacity: 0.1
                                }
                            },
                            dataLabels: {
                                name: {
                                    fontSize: '14px',
                                    color: '#fff',
                                    offsetY: -10,
                                    show: false
                                },
                                value: {
                                    offsetY: 6,
                                    fontSize: '20px',
                                    color: '#fff',
                                    formatter: function (val) {
                                        return val + "%";
                                    }
                                }
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            shadeIntensity: 0.15,
                            gradientToColors: ['#fff'],
                            inverseColors: false,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 50, 65, 91]
                        },
                    },
                    stroke: {
                        dashArray: 4,
                    },
                    colors: ["#fff"],

                    labels: [this.valueTitle],
                },
                chartOptions: {
                    chart: {
                        width: 200,
                        height: 73,
                        zoom: {
                            enabled: false
                        },
                        foreColor: '#4e4e4e',
                        toolbar: {
                            show: false
                        },
                        sparkline: {
                            enabled: true
                        },
                        dropShadow: {
                            enabled: true,
                            opacity: 0.1,
                            blur: 3,
                            left: -4,
                            top: 22,
                        }
                    },
                    plotOptions: {
                        bar: {
                            columnWidth: '30%',
                            endingShape: 'rounded',
                        }
                    },
                    stroke: {
                        width: 0,
                        curve: 'smooth',
                    },
                    dataLabels: {
                        enabled: false
                    },
                    yaxis: [{
                        y: 0,
                        offsetX: 0,
                        offsetY: 0,
                        padding: {
                            left: 0,
                            right: 0
                        }
                    }],
                    tooltip: {
                        theme: 'dark',
                        x: {
                            show: false
                        },

                    },
                    colors: ["#fff"],
                    grid: {
                        show: false,
                        borderColor: 'rgba(66, 59, 116, 0.15)',
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 150,
                                height: 70,
                            }
                        }
                    }]
                },
            }
        },
        computed: {
            procNewValue() {
                let seriesValue = this.procNewSeries;
                if (this.newValue == null || isNaN(this.newValue)) {
                    let arr_count = seriesValue.length;
                    if (arr_count < 1)
                        return 0;
                    return seriesValue[seriesValue.length - 1]
                }
                return this.newValue;
            },
            procNewSeries() {
                let seriesArr = this.seriesValues;
                let arr_count = seriesArr.length;
                if (arr_count < 11) {
                    for (let i = 0; i < (11 - arr_count); i++) {
                        seriesArr.unshift("0");
                    }
                }
                return seriesArr;
            },
            procSeries() {
                return [{
                    name: this.valueTitle,
                    data: this.procNewSeries
                }]
            },

            procRadSeries() {
                return [this.procNewValue];
            }

        },
        watch: {
            newValue: {
                handler(newVal) {
                    if (newVal == null)
                        return;
                    this.seriesValues.push(newVal);
                    this.seriesValues.shift();
                    // this.updateChartData();
                    // this.series[0].data.shift(); //if I decide I want a constant number of values here
                }
            },

            // seriesValues: {
            //     handler(newSeries) {
            //         this.updateChartData();
            //     }
            // }
        },
        methods: {
            updateChartData() {
                this.series = [{
                    data: this.procNewSeries
                }];
            }
        }
    }
</script>
