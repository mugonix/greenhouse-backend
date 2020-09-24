<template>
    <div class="card">
        <div class="card-body">
            <apexchart height="225" type="area" :options="procChartOpts" :series="procNewSeriesValues"></apexchart>
        </div>

    </div>
</template>

<script>
    export default {
        props: {
            newReading: Object,
            seriesValues: Array,
            xAxis: Array
        },
        data: function () {
            return {
                msg: "loading...",
                chartOptions:
                    {
                        chart: {
                            zoom: {
                                enabled: false
                            },
                            foreColor: 'rgba(255, 255, 255, 0.65)',
                            toolbar: {
                                show: false
                            },
                            sparkline: {
                                enabled: false,
                            }
                        },
                        plotOptions: {
                            bar: {
                                columnWidth: '10%',
                                endingShape: 'rounded',
                                dataLabels: {
                                    position: 'top', // top, center, bottom
                                },
                            }
                        },
                        dataLabels: {
                            enabled: false
                        },
                        stroke: {
                            width: 2.5,
                            curve: 'smooth'
                        },

                        yaxis: {
                            axisBorder: {
                                show: false
                            },
                            axisTicks: {
                                show: false,
                            },
                            labels: {
                                show: false,
                                formatter: function (val) {
                                    return parseInt(val);
                                }
                            }
                        },
                        fill: {
                            type: 'solid',
                            gradient: {
                                shade: 'light',
                                gradientToColors: ['rgba(255, 255, 255, 0.1)', '#fff'],
                                shadeIntensity: 1,
                                type: 'vertical',
                                opacityFrom: 1,
                                opacityTo: 1,
                                stops: [0, 80, 100]
                            },
                        },
                        colors: ['rgba(153, 153, 153,1)', 'rgba(255, 255, 255,1)',],
                        legend: {
                            show: !0,
                            position: "top",
                            horizontalAlign: "left",
                            offsetX: -20,
                            fontSize: "12px",
                            markers: {
                                radius: 50,
                                width: 10,
                                height: 10
                            }
                        },
                        grid: {
                            show: true,
                            borderColor: 'rgba(255, 255, 255, 0.12)',
                        },
                        tooltip: {
                            theme: 'dark',
                            // x: {
                            //     format: 'dd/MM/yy HH:mm',
                            // },

                        },
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: {
                                    height: 300
                                },
                                legend: {
                                    offsetX: -20,
                                    fontSize: "12px",
                                }
                            }
                        }]
                    },

            }
        },
        computed: {
            procNewSeriesValues() {
                return this.seriesValues;
            },
            procChartOpts() {
                let XAxisObj = {
                    xaxis: {
                        type: 'categories',
                        categories: this.xAxis,
                    }
                };
                return {...this.chartOptions, ...XAxisObj};

            }
        },
        watch: {
            newReading: {
                handler(newVal) {
                    if (newVal == null)
                        return;

                    let addXLabel = this.addXAxisLabel(newVal.postTime);


                    if (this.seriesValues[0].data.length < this.xAxis.length) {
                        this.seriesValues[1].data.push(newVal.series2NewVal);
                        this.seriesValues[0].data.push(newVal.series1NewVal);
                    } else {
                        let currVal1, currVal2;
                        currVal1 = this.seriesValues[1].data[addXLabel];
                        currVal2 = this.seriesValues[0].data[addXLabel];

                        this.seriesValues[1].data.splice(addXLabel, 1, (currVal1 + newVal.series2NewVal) / 2);
                        this.seriesValues[0].data.splice(addXLabel, 1, (parseFloat(currVal2) + parseFloat(newVal.series1NewVal)) / 2);

                    }

                    // this.updateChartData();
                    // this.series[0].data.shift(); //if I decide I want a constant number of values here
                }
            },
        },
        methods: {
            xAxisLabelPos(label) {
                return this.xAxis.indexOf(label);
            },
            addXAxisLabel(label) {
                let xAxisLabelPos1 = this.xAxisLabelPos(label);
                if (xAxisLabelPos1 === -1) {
                    this.xAxis.push(label);
                    return (this.xAxis.length - 1);
                }
                return xAxisLabelPos1;
            }
        }
    }
</script>

