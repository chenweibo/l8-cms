<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                组件管理
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">新增组件</h3>
                                <p class="mt-1 text-sm text-gray-600">
                                    在这里你可以任意添加你想要的组件。
                                </p>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="#" method="POST">
                                <div class="shadow sm:rounded-md sm:overflow-hidden">
                                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                        <div class="grid grid-cols-3 gap-6">
                                            <div class="col-span-3 sm:col-span-2">
                                                <jet-label for="title" value="名称"/>
                                                <jet-input id="title" v-model="form.label" autocomplete="title"
                                                           class="mt-1 block w-full"
                                                           type="text"/>
                                                <jet-input-error :message="$page.props.errors.label" class="mt-2"/>


                                            </div>
                                        </div>
                                        <div class="grid grid-cols-3 gap-6">
                                            <div class="col-span-3 sm:col-span-2">
                                                <jet-label for="scope" value="作用域"/>
                                                <el-radio-group v-model="form.scope" class="mt-2" size="small">
                                                    <el-radio-button v-for="v in componentScope" :label="v.value">
                                                        {{ v.label }}
                                                    </el-radio-button>

                                                </el-radio-group>
                                                <jet-input-error :message="$page.props.errors.scope" class="mt-2"/>


                                            </div>
                                        </div>

                                        <div class="grid grid-cols-4 gap-6">
                                            <div class="col-span-3 sm:col-span-2">
                                                <jet-label for="type" value="类型"/>
                                                <el-radio-group v-model="form.type" class="mt-2" size="small">
                                                    <el-radio v-for="v in componentType" :label="v.value" class="mb-2">
                                                        {{ v.label }}
                                                    </el-radio>
                                                </el-radio-group>
                                                <jet-input-error :message="$page.props.errors.type" class="mt-2"/>

                                            </div>
                                        </div>

                                        <div class="grid grid-cols-3 gap-6">
                                            <div class="col-span-3 sm:col-span-2">
                                                <jet-label for="column" value="字段 ( 为了防止于系统内部字段冲突，建议增加复杂性 例如 增加前缀 )"/>
                                                <jet-input id="column" v-model="form.column" autocomplete="组件字段"
                                                           class="mt-1 block w-full" type="text"/>
                                                <jet-input-error :message="$page.props.errors.column" class="mt-2"/>

                                            </div>
                                        </div>

<!--                                        <div class="grid grid-cols-3 gap-6">-->
<!--                                            <div class="col-span-3 sm:col-span-2">-->
<!--                                                <jet-label for="show" value="展示"/>-->
<!--                                                <div class="mt-2 border-dashed border-4 border-light-blue-500 p-2">-->
<!--                                                    请选择类型。-->
<!--                                                </div>-->

<!--                                            </div>-->
<!--                                        </div>-->

                                    </div>
                                    <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                        <button
                                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                            type="button"
                                            @click="save">
                                            保存
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetLabel from "@/Jetstream/Label";
import JetInput from "@/Jetstream/Input";
import JetInputError from '@/Jetstream/InputError'
import {componentType, componentScope} from "@/Utils/Index.js";

const defaultForm = {

    id: undefined,
    label: undefined,
    column: undefined,
    note: undefined,
    value: undefined,
    type: undefined,
    scope: undefined

}
export default {
    name: "CustomizeForm",

    components: {
        AppLayout,
        JetLabel,
        JetInput,
        JetInputError
    },
    data() {
        return {
            form: Object.assign({}, defaultForm),
            componentScope: componentScope,
            componentType: componentType,
            errors: this.$page.errors,

        }
    },
    methods: {
        save() {
            this.$inertia.post(route('components.store'), this.form)
        }
    }
}
</script>

<style scoped>

</style>
