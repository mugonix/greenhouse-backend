<template>
    <div class="row mt-4 justify-content-center">
        <div class="col-md-3 mr-4">
            <div class="card">
                <div class="card-header text-uppercase">Temperature Sensor</div>
                <div class="card-body">
                    <form>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Minimum Value</label>
                                <TouchSpinner v-bind:value="environmentalLimits.temperature.lower_limit"
                                              v-bind:min="18"
                                              v-bind:max="32"
                                              v-bind:integerOnly="true"
                                              v-model="environmentalLimits.temperature.lower_limit"
                                              postfix="ºC"></TouchSpinner>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <label>Maximum Value</label>
                                <TouchSpinner v-bind:value="environmentalLimits.temperature.upper_limit"
                                              v-bind:min="18"
                                              v-bind:max="32"
                                              v-bind:integerOnly="true"
                                              v-model="environmentalLimits.temperature.upper_limit"
                                              postfix="ºC"></TouchSpinner>
                            </div>
                        </div>


                        <div class="row mt-3">
                            <div class="col-sm-12 text-center">
                                <button type="button"
                                        @click="updateEnvironmentalLimit('temperature')"
                                        class="btn btn-light">Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3 mr-4">
            <div class="card">
                <div class="card-header text-uppercase">Humidity Sensor</div>
                <div class="card-body">
                    <form>
<!--                        <div class="row">-->
<!--                            <div class="col-sm-12">-->
<!--                                <label>Minimum Value</label>-->
<!--                                <TouchSpinner v-bind:value="environmentalLimits.humidity.lower_limit"-->
<!--                                              v-bind:min="0"-->
<!--                                              v-bind:max="100"-->
<!--                                              v-bind:integerOnly="true"-->
<!--                                              v-model="environmentalLimits.humidity.lower_limit"-->
<!--                                              postfix="%"></TouchSpinner>-->
<!--                            </div>-->
<!--                        </div>-->

                        <div class="row mb-5 mt-4">
                            <div class="col-sm-12 ">
                                <label>Maximum Value</label>
                                <TouchSpinner v-bind:value="environmentalLimits.temperature.upper_limit"
                                              v-bind:min="0"
                                              v-bind:max="100"
                                              v-bind:integerOnly="true"
                                              v-model="environmentalLimits.humidity.upper_limit"
                                              postfix="%"></TouchSpinner>
                            </div>
                        </div>


                        <div class="row mt-3 mb-2">
                            <div class="col-sm-12 text-center">
                                <button type="button"
                                        @click="updateEnvironmentalLimit('humidity')"
                                        class="btn btn-light">Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header text-uppercase">Air Quality Sensor</div>
                <div class="card-body">
                    <form>
                        <div class="row mb-5 mt-4">
                            <div class="col-sm-12">
                                <label>Minimum Value</label>
                                <TouchSpinner v-bind:value="environmentalLimits.air_quality.lower_limit"
                                              v-bind:min="0"
                                              v-bind:max="100"
                                              v-bind:integerOnly="true"
                                              v-model="environmentalLimits.air_quality.lower_limit"
                                              postfix="%"></TouchSpinner>
                            </div>
                        </div>

<!--                        <div class="row">-->
<!--                            <div class="col-sm-12">-->
<!--                                <label>Maximum Value</label>-->
<!--                                <TouchSpinner v-bind:value="environmentalLimits.air_quality.upper_limit"-->
<!--                                              v-bind:min="0"-->
<!--                                              v-bind:max="100"-->
<!--                                              v-model="environmentalLimits.air_quality.upper_limit"-->
<!--                                              v-bind:integerOnly="true"-->
<!--                                              postfix="%"></TouchSpinner>-->
<!--                            </div>-->
<!--                        </div>-->


                        <div class="row mt-3 mb-2">
                            <div class="col-sm-12 text-center">
                                <button type="button"
                                        @click="updateEnvironmentalLimit('air_quality')"
                                        class="btn btn-light">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "GreenhouseConditions",
        props: {
            greenhouseCode: String,
            getEnvLimitsUrl: String,
            updateEnvLimitsUrl: String,
        },
        data: function () {
            return {
                environmentalLimits: {
                    temperature: {
                        lower_limit: 0,
                        upper_limit: 0,
                    },
                    humidity: {
                        lower_limit: 0,
                        upper_limit: 0,
                    },
                    air_quality: {
                        lower_limit: 0,
                        upper_limit: 0,
                    },
                }
            }
        },
        created: function () {
            this.getEnvironmentalLimits();

        },
        methods: {
            getEnvironmentalLimits() {
                let greenhouse_code = this.greenhouseCode;
                let _this = this;
                axios.get(this.getEnvLimitsUrl, {
                    params: {
                        greenhouse_code: greenhouse_code
                    }
                }).then(function (response) {
                    console.log(response);
                    _this.environmentalLimits = response.data;
                }).catch(function (error) {
                    console.log(error);
                });
            },
            updateEnvironmentalLimit(sensor) {
                let greenhouse_code = this.greenhouseCode;
                let _this = this;
                axios.post(this.updateEnvLimitsUrl, {
                    greenhouse_code: greenhouse_code,
                    sensor: sensor,
                    upper_limit: _this.environmentalLimits[sensor].upper_limit,
                    lower_limit: _this.environmentalLimits[sensor].lower_limit

                }).then(function (response) {
                    console.log(response);
                    let sensor_prop = sensor.split("_").join(" ");

                    if (response.data.success) {
                        let toast = _this.$toasted.show("You have successfully updated " + sensor_prop + " sensor limits", {
                            theme: "toasted-primary",
                            position: "top-center",
                            duration: 5000,
                            type: "success"
                        });
                    } else {
                        let toast = _this.$toasted.show("Failed to updated " + sensor_prop + " sensor limits", {
                            theme: "toasted-primary",
                            position: "top-center",
                            duration: 5000,
                            type: "error"
                        });
                    }
                }).catch(function (error) {
                    console.log(error);
                });
            }
        },
        watch: {
            'environmentalLimits.temperature.lower_limit'(newVal) {
                if (newVal > this.environmentalLimits.temperature.upper_limit)
                    this.$set(this.environmentalLimits.temperature, 'upper_limit', newVal);
            },
            'environmentalLimits.temperature.upper_limit'(newVal) {
                if (newVal < this.environmentalLimits.temperature.lower_limit)
                    this.$set(this.environmentalLimits.temperature, 'lower_limit', newVal);
            },
            // 'environmentalLimits.humidity.lower_limit'(newVal) {
            //     if (newVal > this.environmentalLimits.humidity.upper_limit)
            //         this.$set(this.environmentalLimits.humidity, 'upper_limit', newVal);
            // },
            // 'environmentalLimits.humidity.upper_limit'(newVal) {
            //     if (newVal < this.environmentalLimits.humidity.lower_limit)
            //         this.$set(this.environmentalLimits.humidity, 'lower_limit', newVal);
            // },
            // 'environmentalLimits.air_quality.lower_limit'(newVal) {
            //     if (newVal > this.environmentalLimits.air_quality.upper_limit)
            //         this.$set(this.environmentalLimits.air_quality, 'upper_limit', newVal);
            // },
            // 'environmentalLimits.air_quality.upper_limit'(newVal) {
            //     if (newVal < this.environmentalLimits.air_quality.lower_limit)
            //         this.$set(this.environmentalLimits.air_quality, 'lower_limit', newVal);
            // },
        }
    }
</script>
