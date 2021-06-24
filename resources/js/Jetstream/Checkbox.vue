<template>
    <input v-model="z" :value="value"
           @click="selectBox"
           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
           type="checkbox">
</template>

<script>
export default {
    emits: ['update:checked','box-change'],

    props: {
        checked: {
            type: [ Boolean],
            default: false,
        },
        value: {
            default: null,
        },
        val: {
            type: Number,
            default: 0
        }
    },

    computed: {
        proxyChecked: {
            get() {
                return this.checked;
            },

            set(v) {
                this.$emit("update:checked", v);
            },
        },
    },
    data(){
      z:this.checked
    },
    methods: {
        selectBox(){
            this.$emit("box-change", !this.checked,this.val);

            console.log(this.checked)
        }
    },
    watch: {}
}
</script>
