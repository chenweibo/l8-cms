<template>

    <component :is="item.type" v-for="item in content" :content.sync="item"></component>
</template>

<script>
import OneUpload from '@/Components/Upload/OneUpload'
import MultiUpload from '@/Components/Upload/MultiUpload'
import FormInput from '@/Components/FormInput/index'
import Tinymce from '@/Components/Tinymce/index.vue'
import SampleFileUpload from '@/Components/Upload/SampleFileUpload'
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
        SampleFileUpload
    }
}
</script>

<style scoped>

</style>
