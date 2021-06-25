<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                留言管理
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class=" p-8 mt-5 md:mt-0 bg-white md:col-span-2 border-none border-4 border-gray-600 rounded-lg ">


                    <div class="flex justify-between">
                        <div class="left flex">
                            <button
                                class="mr-1 group flex items-center  py-1.5 px-4 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75"
                            >
                                一键已读
                            </button>
                            <button
                                class=" group flex items-center  py-1.5 px-4 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75"
                            >
                                一键清空
                            </button>
                        </div>
                    </div>
                    <div class="bg-white shadow-md rounded my-6 tab-h">
                        <table class="min-w-max w-full table-auto ">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">id</th>
                                <th class="py-3 px-6 text-left">名称</th>
                                <th class="py-3 px-6 text-left">状态</th>
                                <th class="py-3 px-6 text-center">操作</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            <tr v-for="(item,k) in $page.props.list.data" :key="k"
                                class="border-b border-gray-200 hover:bg-gray-100">

                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="font-medium">{{ item.id }}</span>
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    <div class="truncate font-normal" style="width: 200px">
                                        {{ item.name }}
                                    </div>
                                </td>
                                <td class="py-3 px-6 text-left ">
                                    {{ item.is_read ? '已读' : '未读' }}
                                </td>

                                <td class="py-3 px-6 text-center">
                                    <div class="flex item-center justify-center">
                                        <div class="flex inline-flex mr-2" role="group">
                                            <button
                                                class="focus:outline-none text-white text-sm py-1.5 px-2.5 bg-gray-500 rounded-l-md hover:bg-gray-600 hover:shadow-lg"
                                                type="button">
                                                查看
                                            </button>

                                            <button
                                                class="focus:outline-none text-white text-sm py-1.5 px-2.5 bg-red-500 hover:bg-red-600 rounded-r-md  hover:shadow-lg"
                                            >
                                                删除
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <Pagination :current_page="$page.props.list.current_page" :last_page="$page.props.list.last_page"
                                :link="$page.props.list.links"
                                :total="$page.props.list.total" url="messages.index"/>
                </div>

            </div>
        </div>

    </app-layout>

</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Pagination from "@/Components/Pagination/usually.vue"

export default {
    name: "messageList",
    components: {AppLayout, Pagination}
}
</script>

<style scoped>

</style>
