<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                账户管理
            </h2>
        </template>
        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="p-8 mt-5 md:mt-0 bg-white md:col-span-2 border-none border-4 border-gray-600 rounded-lg">
                    <inertia-link :href="route('accounts.create')">
                        <button
                            class="bg-blue-500 px-4 py-2 mb-3 text-xs font-semibold tracking-wider text-white rounded hover:bg-blue-600">
                            新增账号
                        </button>
                    </inertia-link>

                    <div class="bg-white shadow-md rounded my-6 tab-h">
                        <table class="min-w-max w-full table-auto ">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">名称</th>
                                <th class="py-3 px-6 text-left">描述</th>
                                <th class="py-3 px-6 text-center">操作</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="item in $page.props.list" class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left">
                                    <div class="flex items-center">
                                        <div class="mr-2">
                                            <img :src="item.profile_photo_url" class="w-6 h-6 rounded-full"/>
                                        </div>
                                        <span>{{ item.name }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left font-bold">
                                    管理员
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">

                                        <inertia-link :href="route('accounts.edit',item.id)">
                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"/>
                                            </svg>
                                        </div>
                                        </inertia-link>

                                        <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110"
                                             @click="openDelete(item)">
                                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                 xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2"/>
                                            </svg>
                                        </div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <ConfirmationModal :show="show">
                <template #title>
                    删除栏目
                </template>

                <template #content>
                    是否确定删除栏目,不可恢复。
                </template>
                <template #footer>
                    <jet-secondary-button @click="show = null">
                        取消
                    </jet-secondary-button>

                    <jet-danger-button class="ml-2 " @click="handleDelete">
                        确定
                    </jet-danger-button>
                </template>
            </ConfirmationModal>

        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import ConfirmationModal from "@/Jetstream/ConfirmationModal";
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    name: "AccountList",
    components: {
        AppLayout,
        ConfirmationModal,
        JetDangerButton,
        JetSecondaryButton,
    },
    data() {
        return {
            show: false,
            tempId: undefined,
        }
    },
    methods: {
        openDelete(item) {
            //console.log(item)
            this.tempId = item.id
            this.show = true

        },
        handleDelete() {
            //console.log(this.tempId)
            this.$inertia.delete(route('accounts.destroy', this.tempId))
            this.show = false
        },
    }
}
</script>

<style scoped>

</style>
