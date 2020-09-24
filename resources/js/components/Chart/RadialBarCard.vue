<template>
    <div class="card">
        <div class="card-body">
            <div class="media align-items-center">
                <div class="card-content dash-array-chart-box">
                    <apexchart width="180" height="120" type="radialBar" :options="chartOptions"
                               :series="procRadSeries"></apexchart>
                </div>
                <div class="media-body">
                    <h3 class="mt-3 mb-0">{{readingPrefix}}{{procRadNewVal}}{{readingSuffix}}</h3>
                    <p class="mb-0">{{valueTitle}}</p>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            valueTitle: String,
            readingPrefix: {type: String, default: ''},
            readingSuffix: {type: String, default: ''},
            newValue: Number
        },
        data: function () {
            return {
                chartOptions:
                    {
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

            }
        },
        computed: {
            procRadNewVal() {
                if (this.newValue == null)
                    return 0;
                return this.newValue;
            },
            procRadSeries() {
                return [this.procRadNewVal];
            }
        }
    }
</script>


