<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                调用文档
            </h2>
        </template>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

            <div class="flex w-full p-5 mb-3 overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">

                <div class="markdown-body  w-full"  v-html="toHtml">

                </div>
            </div>
        </div>

    </app-layout>

</template>

<script>
import HyperDown from 'hyperdown';
import AppLayout from "@/Layouts/AppLayout";
import {markdown} from 'markdown';

export default {
    name: "applyIndex",
    components: {
        AppLayout
    },
    data() {
        return {}
    },
    created() {
    },
    computed: {
        toHtml() {
            const parser = new HyperDown
            return parser.makeHtml(this.$page.props.content)
        }
    }
}
</script>

<style lang="scss" scoped>



</style>
