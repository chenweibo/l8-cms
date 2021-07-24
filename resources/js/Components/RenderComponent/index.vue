<template>
    <component :is="item.type" v-for="item in content" :content.sync="item"></component>
</template>

<script>
import OneUpload from '@/Components/Upload/OneUpload'
import MultiUpload from '@/Components/Upload/MultiUpload'
import FormInput from '@/Components/FormInput/index'
import Tinymce from '@/Components/Tinymce/index.vue'
import SampleFileUpload from '@/Components/Upload/SampleFileUpload'
import TextArea from '@/Components/FormInput/TextArea'
import DatePicker from '@/Components/FormInput/DatePicker'

export default {
    name: "RenderComponent",
    props: {
        content: Array,
    },
    data() {
        return {}
    },
    components: {
        OneUpload,
        FormInput,
        MultiUpload,
        Tinymce,
        SampleFileUpload,
        TextArea,
        DatePicker
    }
}
</script>

<style scoped>

</style>
