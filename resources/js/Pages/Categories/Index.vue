<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                类目设置
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="w-full  text-white mb-3 border-gray-600 bg-yellow-400">
                    <!--                    <div class="container flex items-center justify-between px-6 py-4 mx-auto">-->
                    <!--                        <div class="flex">-->
                    <!--                            <svg class="w-6 h-6 fill-current" viewBox="0 0 40 40">-->
                    <!--                                <path-->
                    <!--                                    d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"></path>-->
                    <!--                            </svg>-->

                    <!--                            <p class="mx-3">任何对于栏目的操作，需要重新点击下面「 更新栏目 」按钮。</p>-->
                    <!--                        </div>-->

                    <!--                        <button-->
                    <!--                            class="p-1 transition-colors duration-200 transform rounded-md hover:bg-opacity-25 hover:bg-gray-600 focus:outline-none">-->
                    <!--                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">-->
                    <!--                                <path d="M6 18L18 6M6 6L18 18" stroke="currentColor" stroke-linecap="round"-->
                    <!--                                      stroke-linejoin="round" stroke-width="2"/>-->
                    <!--                            </svg>-->
                    <!--                        </button>-->
                    <!--                    </div>-->
                </div>
                <div class=" p-8 mt-5 md:mt-0 bg-white md:col-span-2 border-none border-4 border-gray-600 rounded-lg ">

                    <inertia-link :href="route('categories.create')">
                        <button
                            class="mb-5 group flex items-center  py-1.5 px-4 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                            <svg class="group-hover:text-light-blue-600 text-light-blue-500 mr-2" fill="currentColor" height="20"
                                 width="12">
                                <path clip-rule="evenodd" d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"
                                      fill-rule="evenodd"/>
                            </svg>
                            新增栏目
                        </button>
                    </inertia-link>


                    <div class="bg-white shadow-md rounded my-6 tab-h">
                        <table class="min-w-max w-full table-auto ">
                            <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">id</th>
                                <th class="py-3 px-6 text-left">名称</th>
                                <th class="py-3 px-6 text-left">重定向</th>
                                <th class="py-3 px-6 text-left">链接</th>
                                <th class="py-3 px-6 text-center">排序</th>

                                <th class="py-3 px-6 text-center">栏目图</th>
                                <th class="py-3 px-6 text-center">显示</th>
                                <th class="py-3 px-6 text-left">类型</th>
                                <th class="py-3 px-6 text-center">操作</th>
                            </tr>
                            </thead>
                            <tbody class="text-gray-600 text-sm font-light">
                            <SubLi v-for="menu in $page.props.categoryList" :menu="menu"/>
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>

        </div>

    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'


import SubLi from "./SubLi"

export default {
    components: {
        AppLayout,
        SubLi,
    },
    data() {
        return {
            show: false,
            tempId: undefined,
            defaultProps: {
                children: 'children',
                label: 'name'
            }
        }
    },
    methods: {
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

            this.$inertia.put(route('categories.updateSort', id), {id: id, sort: val})
        },
        reditChange(val, row) {
            let id = row.id

            this.$inertia.put(route('categories.updateRedirect', id), {id: id, redirect: val})
        },
        openDelete(item) {
            this.tempId = item.id
            this.show = true

        },
        handleDelete() {
            console.log(this.tempId)
            this.$inertia.delete(route('categories.destroy', this.tempId)).then(res => {
                this.show = false
            })
        },
        changeStatus(row) {
            const that = this
            this.$confirm('此操作将更改栏目状态, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {
                axios.put(route('categories.updateStatus', row.id), {id: row.id, status: row.status}).then(res => {
                    row.status = res.data.status
                });
            }).catch(() => {

            });
        },
        generate() {
            axios.post(route('categories.generateMenu'),).then(res => {
                this.$message({
                    message: '生成成功',
                    type: 'success'
                });
                console.log(res)
            }).catch(error => {
                this.$message.error('发生异常联系管理员');

            });
        },
        statusChange($event, item) {
            const id = item.id
            const status = $event ? 1 : 0;
            axios.put(route('categories.updateStatus', id), {id: id, status: status})
        }
    }
}
</script>

<style scoped>

.statusYes {
    color: #67C23A;
}

.statusNo {
    color: #000;
}

:deep(.el-input__inner) {
    height: 2em;
}

.tab-h {
    min-height: 500px;
}

</style>
