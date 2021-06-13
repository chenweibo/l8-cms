<template>
    <jet-form-section @submitted="updateBasicInfo">
        <template #title>
            站点信息
        </template>
        <template #description>
            设置您的站点基本信息
            <div class="mt-2.5">
                <el-alert
                    :description="'调用方式：{{  system[ \'标签名称\' ]  }}'"
                    show-icon
                    title="如何使用"
                    type="warning">
                </el-alert>
            </div>

        </template>
        <template #form>
            <RenderComponent v-model:content="mergeContent"/>
        </template>
        <template #actions>
            <jet-action-message :on="form.recentlySuccessful" class="mr-3">
                已保存。
            </jet-action-message>

            <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                保存
            </jet-button>
        </template>
    </jet-form-section>
</template>

<script>
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetButton from '@/Jetstream/Button'
import JetFormSection from '@/Jetstream/FormSection'
import JetInput from '@/Jetstream/Input'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import OneUpload from '@/Components/Upload/OneUpload'
import MultiUpload from '@/Components/Upload/MultiUpload'
import RenderComponent from '@/Components/RenderComponent'


export default {
    name: "UpdateBaseForm",
    components: {
        JetActionMessage,
        JetButton,
        JetFormSection,
        JetInput,
        JetInputError,
        JetLabel,
        OneUpload,
        MultiUpload,
        RenderComponent
    },
    data() {
        return {
            recentlySuccessful:false,
            content: this.$page.props.basic,
            component: this.$page.props.component,
            form: this.$inertia.form({
                '_method': 'PUT',
                options: this.mergeContent,

            }, {
                bag: 'updateBasicInfo',
                resetOnSuccess: false,
            })
        };
    },
    computed: {
        mergeContent() {
            const arr = []
            const that = this
            if (this.component.length > 0) {
                _.forEach(this.component, function (value, index) {//这里规定的就是第一个参数返回的是value值，第二个参数是下标index
                    const id = _.findIndex(that.content, function (o) {
                        return o.column == value.column;
                    });
                    if (id != -1) {
                        arr.push(that.content[id])
                    } else {
                        arr.push(value)
                    }
                });
                return arr
            }
        }
    },
    methods: {
        updateBasicInfo() {
            this.$inertia.put(route('basic.update'),
                {
                    options: this.mergeContent,
                    preserveScroll: true,
                },
                {

                    onSuccess: () => this.form.recentlySuccessful = true,
                }
            )
        }
    }
}
</script>

<style scoped>

</style>
