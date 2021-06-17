<template>
    <div>
        <div class="mt-5 md:mt-0 md:col-span-2 min-h-200">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">
                        <div class="col-span-6 sm:col-span-4">
                            <jet-label for="mc" value="名称"/>
                            <jet-input id="mc" v-model="content.name" autocomplete="名称" class="mt-1 block w-full"
                                       disabled=""
                                       type="text"/>
                        </div>
                        <RenderComponent v-model:content="mergeContent"/>
                    </div>
                </div>
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                    <jet-button @click="save">
                        保存
                    </jet-button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import RenderComponent from "@/Components/RenderComponent";
import JetButton from "@/Jetstream/Button";

export default {
    name: "PageFrame",
    components: {
        JetInput,
        JetLabel,
        RenderComponent,
        JetButton
    },
    data() {
        return {
            content: this.$page.props.content,
            component: this.$page.props.component,
            processing: false
        }
    },
    computed: {
        mergeContent() {
            const arr = []
            const that = this
            if (this.component.length > 0) {
                _.forEach(this.component, function (value, index) {//这里规定的就是第一个参数返回的是value值，第二个参数是下标index
                    const id = _.findIndex(that.content.detail, function (o) {
                        return o.column == value.column;
                    });
                    if (id != -1) {
                        arr.push(that.content.detail[id])
                    } else {
                        arr.push(value)
                    }
                });
                return arr
            }
        },

        handleViewList() {
            if (this.viewList) {
                return this.viewList.filter(item => item !== '.' && item !== '..')
            }
            return [];
        }
    },
    methods: {
        save() {
            const id = this.content.id
            this.$inertia.put(route('contents.update', id),
                {
                    detail: this.mergeContent
                })
        }
    }

}
</script>

<style scoped>

</style>
