<template>
    <div class="col-span-6 sm:col-span-4">
        <jet-label :for="content.column" :value="content.label+' ( '+ content.column+' )'"/>
        <jet-input ref="title" v-model="content.value" autocomplete="current-title"
                   class="mt-1 block w-full" type="text"/>
    </div>
</template>

<script>
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";

export default {
    name: "index",
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
