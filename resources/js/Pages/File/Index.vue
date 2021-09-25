<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                文件管理
            </h2>
        </template>

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
                           支持的文件操作 zip解压，重命名，编辑，删除，新建文件，新建目录，文件上传。
                        </p>
                    </div>
                </div>
            </div>
            <div class="p-8   md:mt-0 bg-white md:col-span-2 border-none border-4 border-gray-600 rounded-lg ">

                    <el-tabs type="border-card">
                        <el-tab-pane label="模板资源"><FilesList disk="templates"/></el-tab-pane>
                        <el-tab-pane label="样式资源"><FilesList disk="style"/></el-tab-pane>
                        <el-tab-pane label="文件资源"><FilesList disk="uploads"/></el-tab-pane>
                    </el-tabs>

            </div>
        </div>
    </app-layout>
</template>
<script>
import AppLayout from '@/Layouts/AppLayout'
import FilesList from './FilesList'
export default {
    name: "Index",
    components: {
        AppLayout,
        FilesList
    },
}
</script>
