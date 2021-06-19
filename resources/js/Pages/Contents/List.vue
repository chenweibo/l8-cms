<template>
    <app-layout>
        <div class="flex-col w-full md:flex md:flex-row md:min-h-screen bg-blueGray-50">


            <div class="flex flex-col w-64 h-screen px-4  bg-white border-r dark:bg-gray-800 dark:border-gray-600">

                <div class="flex flex-col justify-between flex-1 mt-6">
                    <nav>
                        <Menu v-for="menu in $page.props.menu" :model="menu"/>
                    </nav>

                </div>
            </div>
            <div v-if="$page.props.isIndex" class="flex-grow   py-10 sm:px-6 lg:px-8 ">
                <div
                    class="flex-1 min-h-full  min-w-full rounded-3xl bg-white shadow-xl p-10 lg:p-20  text-gray-800 relative md:flex items-center text-center md:text-left">
                    <div class="w-full md:w-1/2">
                        <div class="mb-8 lg:mb-20">
                            <img src="/static/common/Group.svg">
                        </div>
                        <div class="mb-10 md:mb-20 text-gray-600 font-light">
                            <h1 class="font-black uppercase text-3xl lg:text-5xl text-indigo-700 mb-10">hi<br>管理员</h1>
                            <p>点击右侧标星栏目进行内容编辑。</p>
                            <p></p>
                        </div>
                        <div class="mb-20 md:mb-0">
                            <button
                                class="text-lg font-light outline-none focus:outline-none transform transition-all hover:scale-110 text-blue-500 hover:text-blue-600"></button>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 text-center">
                        <img class="w-64 h-64" src="/static/common/404.png">

                    </div>
                </div>
            </div>
            <div v-else class="flex-grow   py-4 sm:px-6 lg:px-8 ">
                <div class="mb-4 bg-white p-4">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item>位置</el-breadcrumb-item>
                        <el-breadcrumb-item>{{ $page.props.title }}</el-breadcrumb-item>
                    </el-breadcrumb>
                </div>


                <div
                    class="pt-5 px-4 md:min-h-screen mt-5 md:mt-0 bg-white md:col-span-2 border-none border-4 border-gray-600 rounded-lg ">
                    <component v-bind:is="$page.props.frameName"></component>
                </div>

            </div>
        </div>

        <div>
        </div>

    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import Menu from "./Menu.vue";
import ListFrame from './ListFrame';
import PageFrame from './PageFrame';

export default {
    name: "List",
    components: {
        AppLayout,
        Menu,
        ListFrame,
        PageFrame
    },
    methods: {
        changeMenu() {

        }
    }
}
</script>

<style scoped>

</style>
