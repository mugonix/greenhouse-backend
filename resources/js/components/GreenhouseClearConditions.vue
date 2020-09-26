<template>
    <div class="dropdown-menu" x-placement="top-start"
         style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(108px, -2px, 0px);">
        <a href="javaScript:void();" @click.prevent="clearConditions()" class="dropdown-item">Clear Environment
            Conditions</a>
    </div>
</template>

<script>
export default {
    name: "GreenhouseClearConditions",
    props: {
        greenhouseClearConditionsUrl: String,
    },
    methods: {
        clearConditions() {
            let _this = this;
            axios.get(this.greenhouseClearConditionsUrl)
                .then((response) => {
                    if (response.data.status === "ok") {
                        let toast = _this.$toasted.show("You have successfully cleared greenhouse conditions", {
                            theme: "toasted-primary",
                            position: "top-center",
                            duration: 5000,
                            type: "success"
                        });
                        return;
                    }
                    let toast = _this.$toasted.show("Failed to cleared greenhouse conditions", {
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
