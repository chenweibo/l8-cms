<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                账户管理
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="flex flex-row justify-end">
                </div>
                <div class="md:grid md:grid-cols-3 md:gap-6 mt-10 ">
                    <jet-section-title>
                        <template #title>
                            <slot name="title">用户信息</slot>
                        </template>
                        <template #description>
                            <slot name="description">填写用户信息。</slot>
                            <br>
                        </template>
                    </jet-section-title>
                    <div class="mt-5 md:mt-0 md:col-span-2 min-h-200">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="mc" value="名称"/>
                                        <jet-input id="mc" autocomplete="名称"
                                                   class="mt-1 block w-full"
                                                   v-model="form.name"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.name" class="mt-2"/>

                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="username" value="邮箱 ( 用于登陆 )"/>
                                        <jet-input id="username" autocomplete="邮箱"
                                                   class="mt-1 block w-full"
                                                   v-model="form.email"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.email" class="mt-2"/>

                                    </div>
                                </div>
                            </div>
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="mc" value="密码"/>
                                        <jet-input id="password" autocomplete="密码"
                                                   class="mt-1 block w-full"
                                                   v-model="form.password"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.password" class="mt-2"/>

                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <el-button size="small" type="info" @click="save"  >保存</el-button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetSectionTitle from "@/Jetstream/SectionTitle";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";

export default {
    name: "AccountForm",
    components: {
        AppLayout,
        JetSecondaryButton,
        JetSectionTitle,
        JetInput,
        JetLabel,
        JetInputError,
        JetActionMessage,
        JetButton,
    },
    data(){
        return {
            isEdit:this.$page.props.isEdit,
            form: {
                id:undefined,
                name: '',
                email: '',
                password: '',
            }
        }
    },
    mounted() {
        if (this.isEdit){
            this.form = this.$page.props.account
        }
    },
    methods:{
        save() {

            if (this.isEdit) {

                this.$inertia.put(route('accounts.update', this.form.id), this.form)

            } else {
                this.$inertia.post(route('accounts.store'), this.form)
            }
        }
    }
}
</script>

<style scoped>

</style>
