<template>
    <div class="col-span-6 sm:col-span-4">
        <jet-label :for="content.column" :value="content.label+' ( '+ content.column+' )'"/>
        <textarea v-model="content.value" class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm mt-1 block w-full"  cols="4" rows="12  ">内容</textarea>
    </div>
</template>

<script>
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";

export default {
    name: "TextArea",
    props: {
        content: {
            type: Object,
            default: function () {
                return {
                    id: undefined,
                    value: undefined,
                    label: '',
                    column: '',
                    note: []
                }
            }
        },
    },
    components: {
        JetLabel,
        JetInput
    }
}
</script>

<style scoped>

</style>
