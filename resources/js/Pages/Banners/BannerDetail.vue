<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.isEdit ? '编辑幻灯片' : '创建幻灯片' }}
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="flex flex-row justify-end">
                    <div class=" py-4">
                        <el-button type="text" @click="addForm" >新增一组幻灯片</el-button>
                    </div>
                </div>


                <div class="md:grid md:grid-cols-3 md:gap-6 mt-10 ">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">基本信息</h3>
                            <p class="mt-1 text-sm text-gray-600">
                                填写您的幻灯片用途及描述。
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="mc" value="名称"/>
                                        <jet-input id="mc" v-model="form.name" autocomplete="名称" class="mt-1 block w-full"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.name" class="mt-2"/>

                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="description" value="描述"/>
                                        <jet-input id="description" v-model="form.description" autocomplete="描述"
                                                   class="mt-1 block w-full"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.description" class="mt-2"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div v-for="(item,k) in banners" :key="k">
                    <banner-form :banner="item" :i="k" @remove="removeForm"/>
                </div>
                <div class="md:grid md:grid-cols-3 md:gap-6 mt-10 ">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900"></h3>
                            <p class="mt-1 text-sm text-gray-600">
                            </p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div
                            class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                            <el-button @click="save" type="info" >保存</el-button>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import BannerForm from './BannerForm'
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetSectionTitle from '@/Jetstream/SectionTitle'
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetInputError from '@/Jetstream/InputError'

export default {
    components: {
        AppLayout,
        BannerForm,
        JetSecondaryButton,
        JetSectionTitle,
        JetInput,
        JetLabel,
        JetInputError
    },
    created() {
    },
    mounted() {

        if (this.isEdit) {
            this.form = this.$page.props.banners
            this.banners = this.$page.props.banners.banners

        }

    },
    data() {
        return {
            isEdit: this.$page.props.isEdit,
            temp: this.$page.props.component,
            banners: [this.$page.props.component],
            form: {
                name: '',
                description: '',
                banners: ''
            },
            // error:this.$page.error,
        }
    },
    methods: {
        addForm() {
            this.banners.push(JSON.parse(JSON.stringify(this.temp)))
        },
        removeForm(i) {

            this.banners.splice(i, 1);
        },
        save() {
            const that = this
            //提交时处理排序
            // const data = _.sortBy(this.banners, function (item) {
            //     return item.sort;
            // });
            // this.form.banners = data
            if (!this.isEdit) {
                this.form.banners = this.banners
                this.$inertia.post(route('banners.store'), this.form)

            } else {
                this.$inertia.put(route('banners.update', this.form.id), this.form)
            }

        }
    }
}
</script>
