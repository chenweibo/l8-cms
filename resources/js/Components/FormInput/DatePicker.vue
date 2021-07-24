<template>
    <div class="col-span-6 sm:col-span-4">
        <jet-label :for="content.column" :value="content.label+' ( '+ content.column+' )'"/>
        <el-date-picker
            v-model="content.value"
            placeholder="选择日期时间"
            class="mt-1"
            type="datetime">
        </el-date-picker>
    </div>
</template>

<script>
import JetLabel from "@/Jetstream/Label";

export default {
    name: "DatePicker",
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
        JetLabel
    }
}
</script>

<style scoped>

</style>
