<template>
    <div class="input-group bootstrap-touchspin">
        <span class="input-group-prepend">
            <button @click='decreaseNumber'
                    @mousedown='whileMouseDown(decreaseNumber)'
                    @mouseup='clearTimer'
                    :class='buttonClass'
                    type="button">-</button>
        </span>
        <span class="input-group-text" v-show="prefix !== ''">{{prefix}}</span>
        <input type="text"
               v-bind:value='numericValue'
               @keypress='validateInput'
               @input='inputValue'
               :class='inputClass'
               style="display: block;">
        <span class="input-group-text" v-show="postfix !== ''">{{postfix}}</span>
        <span class="input-group-append">
            <button @click='increaseNumber'
                    @mousedown='whileMouseDown(increaseNumber)'
                    @mouseup='clearTimer'
                    :class='buttonClass'
                    type="button">+</button>
        </span>
    </div>
</template>

<script>
    export default {
        name: 'TouchSpinner',
        data: function () {
            return {
                numericValue: this.value,
                timer: null
            };
        },

        props: {
            value: {
                type: Number,
                default: 0
            },
            min: {
                default: 0,
                type: Number
            },
            max: {
                default: 10,
                type: Number
            },
            step: {
                default: 1,
                type: Number
            },
            mouseDownSpeed: {
                default: 100,
                type: Number
            },
            inputClass: {
                default: 'form-control',
                type: String
            },
            buttonClass: {
                default: 'btn btn-light',
                type: String
            },
            integerOnly: {
                default: false,
                type: Boolean
            },
            prefix: {
                default: '',
                type: String
            },
            postfix: {
                default: '',
                type: String
            }
        },
        computed: {
            // proceNewValue() {
            //     return this.numericValue;
            // }
        },
        methods: {
            clearTimer() {
                if (this.timer) {
                    clearInterval(this.timer);
                    this.timer = null;
                }
            },

            whileMouseDown(callback) {
                if (this.timer === null) {
                    this.timer = setInterval(() => {
                        callback();
                    }, 100);
                }
            },

            increaseNumber() {
                this.numericValue += this.step;
            },

            decreaseNumber() {
                this.numericValue -= this.step;
            },

            isInteger(evt) {
                evt = evt ? evt : window.event;
                let key = evt.keyCode || evt.which;
                key = String.fromCharCode(key);
                const regex = /[0-9]/;

                if (!regex.test(key)) {
                    evt.returnValue = false;
                    if (evt.preventDefault) evt.preventDefault();
                }
            },

            isNumber(evt) {
                evt = evt ? evt : window.event;
                var charCode = evt.which ? evt.which : evt.keyCode;

                if (
                    charCode > 31 &&
                    (charCode < 48 || charCode > 57) &&
                    charCode !== 46
                ) {
                    evt.preventDefault();
                } else {
                    return true;
                }
            },

            validateInput(evt) {
                if (this.integerOnly === true) {
                    this.isInteger(evt);
                } else {
                    this.isNumber(evt);
                }
            },

            inputValue(evt) {
                this.numericValue = evt.target.value
                    ? parseInt(evt.target.value)
                    : this.min;
            }
        },

        watch: {
            value: {
                handler(newValue) {
                    this.numericValue = newValue;
                }
            },
            numericValue: function (val, oldVal) {
                if (val <= this.min) {
                    this.numericValue = parseInt(this.min);
                }

                if (val >= this.max) {
                    this.numericValue = parseInt(this.max);
                }

                if (val <= this.max && val >= this.min) {
                    this.$emit('input', val, oldVal);
                }
            }
        }
    };
</script>
