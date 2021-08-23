<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                类目设置
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                <div class="flex w-full  mb-3 overflow-hidden bg-white rounded-lg shadow-md dark:bg-gray-800">
                    <div class="flex items-center justify-center w-12 bg-blue-500">
                        <svg class="w-6 h-6 text-white fill-current" viewBox="0 0 40 40"
                             xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20 3.33331C10.8 3.33331 3.33337 10.8 3.33337 20C3.33337 29.2 10.8 36.6666 20 36.6666C29.2 36.6666 36.6667 29.2 36.6667 20C36.6667 10.8 29.2 3.33331 20 3.33331ZM21.6667 28.3333H18.3334V25H21.6667V28.3333ZM21.6667 21.6666H18.3334V11.6666H21.6667V21.6666Z"/>
                        </svg>
                    </div>

                    <div class="px-4 py-2 -mx-3 ">
                        <div class="mx-3">
                            <span class="font-semibold text-blue-500 dark:text-blue-400">提示</span>
                            <p class="text-sm text-gray-600 dark:text-gray-200">
                                新增栏目以及修改栏目url等操作需要点击下方，生成导航按钮重新生成对应url。</p>
                        </div>
                    </div>
                </div>
                <div class=" p-8 mt-5 md:mt-0 bg-white md:col-span-2 border-none border-4 border-gray-600 rounded-lg ">

                    <div class="flex">
                        <inertia-link :href="route('categories.create')" as="button"
                                      class="mb-5 group flex items-center mr-2  py-1.5 px-4 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
                            <svg class="group-hover:text-light-blue-600 text-light-blue-500 mr-2" fill="currentColor"
                                 height="20"
                                 width="12">
                                <path clip-rule="evenodd"
                                      d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"
                                      fill-rule="evenodd"/>
                            </svg>
                            新增栏目
                        </inertia-link>
<!--                        <inertia-link :href="route('categories.create')" as="button"-->
<!--                                      class="mb-5 group flex items-center   py-1.5 px-4 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">-->
<!--                            <svg  class="h-5 w-5 mr-1" fill="#FBBF24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">-->
<!--                                <path-->
<!--                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>-->
<!--                            </svg>-->

<!--                            生成导航-->
<!--                        </inertia-link>-->
                    </div>

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
