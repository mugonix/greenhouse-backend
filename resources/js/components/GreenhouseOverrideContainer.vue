<template>
    <div class="dropdown-menu" x-placement="bottom-start"
         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 36px, 0px);">
        <a href="javaScript:void();" @click.prevent="updateActuatorState('ON')" class="dropdown-item">Override ON</a>
        <a href="javaScript:void();" @click.prevent="updateActuatorState('OFF')" class="dropdown-item">Override OFF</a>
        <a href="javaScript:void();" @click.prevent="updateActuatorState('DISABLE')" class="dropdown-item">Disable
            Override</a>
    </div>
</template>

<script>
export default {
    name: "GreenhouseOverrideContainer",
    props: {
        greenhouseOverrideUrl: String,
        actuator: String
    },
    methods: {
        updateActuatorState(state) {
            let _this = this;
            axios.post(this.greenhouseOverrideUrl, {
                actuator: this.actuator,
                state
            }).then((response) => {
                if (response.data.status === "ok") {
                    let toast = _this.$toasted.show("You have successfully updated actuator state", {
                        theme: "toasted-primary",
                        position: "top-center",
                        duration: 5000,
                        type: "success"
                    });
                    return;
                }
                let toast = _this.$toasted.show("Failed to update actuator state", {
                    theme: "toasted-primary",
                    position: "top-center",
                    duration: 5000,
                    type: "error"
                });
            });
        }
    }
}
</script>

<style scoped>

</style>
