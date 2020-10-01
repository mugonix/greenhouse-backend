<template>
    <div class="row mt-3">
        <div class="col-12">
            <div class="row">
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="card bubble">
                        <div class="card-body card-block">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <p class="mb-0 text-white">Energy Usage</p>
                                    <h4 class="mb-0 text-white">{{ proc_month_energy_unit }}Wh</h4>
                                    <p class="extra-small-font mt-3 mb-0 text-white">Energy Used in <br>The past 30 days
                                    </p>
                                </div>
                                <div class="position-relative"><i class="fas fa-lightbulb fa-5x text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-6">
                    <div class="card bubble">
                        <div class="card-body card-block">
                            <div class="media align-items-center">
                                <div class="media-body">
                                    <p class="mb-0 text-white">Water Usage</p>
                                    <h4 class="mb-0 text-white">{{proc_month_water_volume}}L</h4>
                                    <p class="extra-small-font mt-3 mb-0 text-white">Water Used in <br>The past 30 days
                                    </p>
                                </div>
                                <div class="position-relative"><i class="fas fa-shower fa-5x text-white"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-lg-12 col-xl-6">
                    <area-chart-card
                        v-bind:newReading="procNewTemperatureReadings"
                        v-bind:seriesValues="procTemperatureSeries"
                        v-bind:xAxis="greenHouseMetrics.post_time"></area-chart-card>

                    <area-chart-card
                        v-bind:newReading="procNewHumidityReadings"
                        v-bind:seriesValues="procHumiditySeries"
                        v-bind:xAxis="greenHouseMetrics.post_time"></area-chart-card>

                </div>
                <div class="col-12 col-lg-12 col-xl-6">
                    <div class="card-deck flex-column flex-xl-row ">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col" v-for="actuator in actuatorStateList">
                                        <strong>{{ actuatorDisplayable(actuator.actuator) }}</strong> -
                                        <span class="badge badge-success badge-pill">
                                {{ actuator.state }} ({{ control_level(actuator.control_level) }})
                                </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-deck flex-column flex-xl-row ">
                        <area-chart-widget-card cardIcon="fas fa-plug"
                                                v-bind:newReading="newEnergyUnit"
                                                readingSuffix="W"
                                                cardTitle="Power Usage"
                                                v-bind:seriesValues="greenHouseMetrics.energy_unit"></area-chart-widget-card>
                        <area-chart-widget-card cardIcon="fas fa-faucet"
                                                v-bind:newReading="newWaterVolume"
                                                readingSuffix="mL"
                                                cardTitle="Water Usage"
                                                v-bind:seriesValues="greenHouseMetrics.water_volume"></area-chart-widget-card>
                    </div>
                    <bar-chart-widget-card valueTitle="Air Quality"
                                           card-icon="fas fa-wind"
                                           readingSuffix="%"
                                           v-bind:newValue="newAirQuality"
                                           v-bind:seriesValues="greenHouseMetrics.air_quality"></bar-chart-widget-card>

                    <bar-chart-widget-card valueTitle="Soil Moisture"
                                           card-icon="fas fa-water"
                                           readingSuffix="%"
                                           v-bind:newValue="newSoilMoisture"
                                           v-bind:seriesValues="greenHouseMetrics.soil_moisture"></bar-chart-widget-card>

                </div>
            </div>
        </div>
    </div>
</template>

<script>
const abbreviate = require('number-abbreviate')
export default {
    props: {
        greenhouseCode: String,
        pastMetricUrl: String
    },
    data() {
        return {
            greenHouseMetrics: {
                temperature: [],
                humidity: [],
                temperature_outdoor: [],
                humidity_outdoor: [],
                air_quality: [],
                soil_moisture: [],
                water_volume: [],
                energy_unit: [],
                post_time: [],
                month_water_volume: 0,
                month_energy_unit: 0,
            },
            newTemperature: null,
            newHumidity: null,
            newTemperatureOutdoor: null,
            newHumidityOutdoor: null,
            newAirQuality: null,
            newSoilMoisture: null,
            newWaterVolume: null,
            newEnergyUnit: null,
            newPostTime: null,
            newTimeStamp: null,
            actuatorStateList: []

        }
    },
    created: function () {
        this.loadValues();

        let greenhouse_code = this.greenhouseCode;
        // console.log(greenhouse_code);
        Echo.private('App.Greenhouse.' + greenhouse_code)
            .listen('NodeSentMetrics', (e) => {
                // console.log(e);
                this.newTemperature = e.greenhouse_metrics.temperature;
                this.newHumidity = e.greenhouse_metrics.humidity;
                this.newTemperatureOutdoor = e.greenhouse_metrics.temperature_outdoor;
                this.newHumidityOutdoor = e.greenhouse_metrics.humidity_outdoor;
                this.newAirQuality = e.greenhouse_metrics.air_quality;
                this.newSoilMoisture = e.greenhouse_metrics.soil_moisture;
                this.newWaterVolume = e.greenhouse_metrics.water_volume;
                this.newEnergyUnit = e.greenhouse_metrics.energy_unit;
                this.newPostTime = e.post_time;
                this.newTimeStamp = e.greenhouse_metrics.created_at;

                this.greenHouseMetrics.month_water_volume = e.month_utilisation.total_water_volume;
                this.greenHouseMetrics.month_energy_unit = e.month_utilisation.total_energy_unit;

                this.actuatorStateList = e.greenhouse_actuator;
            });

    },
    computed: {
        proc_month_water_volume() {
            return abbreviate(this.greenHouseMetrics.month_water_volume,3)
        },
        proc_month_energy_unit() {
            return abbreviate(this.greenHouseMetrics.month_energy_unit,2)
        },
        procTemperatureSeries() {
            return [
                {name: 'Outdoor Temperature', data: this.greenHouseMetrics.temperature_outdoor},
                {name: 'Greenhouse Temperature', data: this.greenHouseMetrics.temperature}
            ];
        },
        procNewTemperatureReadings() {
            return {
                timestamp: this.newTimeStamp,
                postTime: this.newPostTime,
                series2NewVal: this.newTemperature,
                series1NewVal: this.newTemperatureOutdoor
            };
        },
        procHumiditySeries() {
            return [
                {name: 'Outdoor Humidity', data: this.greenHouseMetrics.humidity_outdoor},
                {name: 'Greenhouse Humidity', data: this.greenHouseMetrics.humidity}
            ];
        },
        procNewHumidityReadings() {
            return {
                timestamp: this.newTimeStamp,
                postTime: this.newPostTime,
                series2NewVal: this.newHumidity,
                series1NewVal: this.newHumidityOutdoor
            };
        }
    },
    methods: {
        loadValues() {
            let greenhouse_code = this.greenhouseCode;
            let _this = this;
            axios.get(this.pastMetricUrl, {
                params: {
                    greenhouse_code: greenhouse_code
                }
            }).then(function (response) {
                // console.log(response);
                _this.greenHouseMetrics = response.data;
            }).catch(function (error) {
                console.log(error);
            });
        },
        control_level(level) {
            switch (level) {
                case 0:
                    return "Default";
                case 1:
                    return "Condition";
                case 2:
                    return "Override";
                default:
                    return "Unknown";
            }
        },
        actuatorDisplayable(name) {
            return this.capitalize(name.split("_").join(" "))
        },
        /**
         * Capitalizes first letters of words in string.
         * @param {string} str String to be modified
         * @param {boolean=true} lower Whether all other letters should be lowercased
         * @return {string}
         * @usage
         *   capitalize('fix this string');     // -> 'Fix This String'
         *   capitalize('javaSCrIPT');          // -> 'JavaSCrIPT'
         *   capitalize('javaSCrIPT', true);    // -> 'Javascript'
         */
        capitalize(str, lower = true) {
            return (lower ? str.toLowerCase() : str).replace(/(?:^|\s|["'([{])+\S/g, match => match.toUpperCase());
        }
    }
}
</script>

