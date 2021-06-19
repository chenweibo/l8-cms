<template>
    <div>

        <inertia-link :href="route('contents.create')">
            <button
                class=" group flex items-center  py-1.5 px-4 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                <svg class="group-hover:text-light-blue-600 text-light-blue-500 mr-2" fill="currentColor" height="20"
                     width="12">
                    <path clip-rule="evenodd"
                          d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"
                          fill-rule="evenodd"/>
                </svg>
                新增内容
            </button>
        </inertia-link>


        <div class="bg-white shadow-md rounded my-4 tab-h" style="min-height: 600px">
            <table class=" w-full table-auto ">
                <thead>
                <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">id</th>
                    <th class="py-3 px-6 text-left">名称</th>
                    <th class="py-3 px-6 text-left">所属</th>
                    <th class="py-3 px-6 text-left">重定向</th>
                    <th class="py-3 px-6 text-center">排序</th>
                    <th class="py-3 px-6 text-center">缩略图</th>
                    <th class="py-3 px-6 text-center">显示</th>
                    <th class="py-3 px-6 text-center">操作</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 text-sm font-light">
                <tr v-for="(item,k) in content" :key="k"
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
                        {{ $page.props.title }}
                    </td>
                    <td class="py-3 px-6 text-left">
                        <el-input v-model="item.redirect" placeholder="重定向"
                                  style="width: 8em;"
                                  @change="((val)=>{reditChange(val, item)})"></el-input>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <el-input v-model="item.sort" class="text-center" placeholder=""
                                  style="width: 50px; padding: 0;"
                                  @change="((val)=>{sortChange(val, item)})"></el-input>
                    </td>
                    <td class="py-3 px-6 text-left whitespace-nowrap">
                        头像
                    </td>
                    <td class="py-3 px-6 text-center">
                        <el-switch
                            v-model="item.status"
                            @change="statusChange($event,item)"
                        >
                        </el-switch>
                    </td>
                    <td class="py-3 px-6 text-center">
                        <div class="flex item-center justify-center">
                            <div class="flex inline-flex mr-2" role="group">
                                <inertia-link :href="route('contents.edit',item.id)">
                                    <button
                                        class="focus:outline-none text-white text-sm py-1.5 px-2.5 bg-gray-500 rounded-l-md hover:bg-gray-600 hover:shadow-lg"
                                        type="button">
                                        编辑
                                    </button>
                                </inertia-link>
                                <button
                                    class="focus:outline-none text-white text-sm py-1.5 px-2.5 bg-red-500 hover:bg-red-600 rounded-r-md  hover:shadow-lg"
                                    @click="openDelete(item)"
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
        <Pagination/>
    </div>
</template>

<script>
import {ElBreadcrumb, ElBreadcrumbItem} from 'element-plus';
import Pagination from "@/Components/Pagination/index"

export default {
    name: "ListFrame",
    components: {Pagination,ElBreadcrumb,ElBreadcrumbItem},
    data() {
        return {
            content: this.$page.props.content.data,
            total: this.$page.props.content.total,
            last_page: this.$page.props.content.last_page,
        }
    },
    methods: {
        reditChange(val, row) {

            let id = row.id
            // this.$inertia.put(route('categories.updateRedirect', id), {id: id, redirect: val})
        },
        sortChange(val, row) {
            let id = row.id
            if (isNaN(val)) {
                this.$notify({
                    title: '提示',
                    message: '修改失败，您输入的不是数字。',
                    type: 'warning'
                });
                return false
            }

            //this.$inertia.put(route('categories.updateSort', id), {id: id, sort: val})
        },
        statusChange() {

        },
        openDelete() {

        }

    }
}
</script>

<style scoped>
:deep(.el-input__inner) {
    height: 2em;
}
</style>
