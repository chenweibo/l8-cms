<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                组件设置
            </h2>
        </template>
        <div>

            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="p-8 mt-5  md:mt-0 bg-white md:col-span-2 border-none border-4 border-gray-600 rounded-lg ">
                    <inertia-link :href="route('components.create')">

                    <button
                        class="bg-blue-500 px-4 py-2 mb-3 text-xs font-semibold tracking-wider text-white rounded hover:bg-blue-600">
                        新增组件
                    </button>
                    </inertia-link>
                    <div class="flex flex-col">
                        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                scope="col">
                                                名称
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                scope="col">
                                                作用域
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                scope="col">
                                                类型
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                                scope="col">
                                                标签
                                            </th>
                                            <th class="relative px-6 py-3" scope="col">
                                                <span class="sr-only">删除</span>
                                            </th>
                                        </tr>
                                        </thead>
                                        <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="item in $page.props.list.data">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="flex text-sm items-center">
                                                    {{ item.label }}
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <div class="text-sm text-gray-900">
                                                    {{ componentScope[item.scope].label }}
                                                </div>

                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                   {{ componentTiled[item.type] }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ item.column }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a class="text-indigo-600 hover:text-indigo-900  cursor-pointer"
                                                   @click="readyDelete(item.id)">删除</a>
                                            </td>
                                        </tr>

                                        <!-- More people... -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- This example requires Tailwind CSS v2.0+ -->
                    <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                        <div class="flex-1 flex justify-between sm:hidden">
                            <inertia-link
                                :href="$page.props.list.prev_page_url?$page.props.list.prev_page_url:'#'"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                上一页
                            </inertia-link>
                            <inertia-link
                                :href="$page.props.list.next_page_url?$page.props.list.next_page_url:'#'"
                                class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                下一页
                            </inertia-link>
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>

                                <p class="text-sm text-gray-700">
                                    显示
                                    <span class="font-medium">{{ $page.props.list.total }}</span>
                                    个结果中的
                                    <span class="font-medium">{{ $page.props.list.from }}</span>
                                    到
                                    <span class="font-medium">{{ $page.props.list.to }}</span>
                                    当前页:
                                    <span class="font-medium">{{ $page.props.list.current_page }}</span>

                                </p>
                            </div>
                            <div>
                                <nav aria-label="Pagination"
                                     class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">

                                    <inertia-link
                                        :href="$page.props.list.prev_page_url?$page.props.list.prev_page_url:'javascript:void(0);'"
                                        class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">

                                        <span class="sr-only">上一页</span>
                                        <!-- Heroicon name: solid/chevron-left -->
                                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd"
                                                  d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                  fill-rule="evenodd"/>
                                        </svg>

                                    </inertia-link>

                                    <inertia-link
                                        :href="$page.props.list.next_page_url?$page.props.list.next_page_url:'javascript:void(0);'"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">下一页</span>
                                        <!-- Heroicon name: solid/chevron-right -->
                                        <svg aria-hidden="true" class="h-5 w-5" fill="currentColor"
                                             viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path clip-rule="evenodd"
                                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                  fill-rule="evenodd"/>
                                        </svg>

                                    </inertia-link>

                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Account Confirmation Modal -->
        <jet-dialog-modal :show="confirmingDelete" @close="closeModal">
            <template #title>
                删除组件
            </template>

            <template #content>
                是否确定删除组件？
            </template>

            <template #footer>
                <jet-secondary-button @click="closeModal">
                    取消
                </jet-secondary-button>
                <jet-danger-button class="ml-2" @click="confirmDelete">
                    确定
                </jet-danger-button>
            </template>
        </jet-dialog-modal>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import {componentTiled, componentScope} from "@/Utils/Index.js";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetDangerButton from "@/Jetstream/DangerButton";


export default {
    components: {
        AppLayout,
        JetDialogModal,
        JetSecondaryButton,
        JetDangerButton
    },
    created() {
    },
    data() {
        return {
            componentScope: componentScope,
            componentTiled: componentTiled,
            confirmingDelete: false,
            deleteId: undefined
        }
    },
    methods: {
        closeModal() {
            this.confirmingDelete = false
        },
        confirmDelete() {

            this.$inertia.delete(route('components.destroy', this.deleteId))
            this.confirmingDelete = false
        },
        readyDelete(id) {
            this.deleteId = id
            this.confirmingDelete = true

        }
    }

}
</script>
