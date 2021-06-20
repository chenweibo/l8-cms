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
            <div class="flex-grow   py-4 sm:px-6 lg:px-8 ">
                <div class="mb-4 bg-white p-4">
                    <el-breadcrumb separator-class="el-icon-arrow-right">
                        <el-breadcrumb-item>位置</el-breadcrumb-item>
                        <el-breadcrumb-item>{{ $page.props.title }}</el-breadcrumb-item>
                    </el-breadcrumb>
                </div>


                <div
                    class="pt-5 px-4 md:min-h-screen mt-5 md:mt-0 bg-white md:col-span-2 border-none border-4 border-gray-600 rounded-lg ">
                    <div class="mt-5 md:mt-0 md:col-span-2 min-h-200">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="mc" value="名称"/>
                                        <jet-input id="mc" autocomplete="名称" class="mt-1 block w-full"

                                                   type="text"/>
                                    </div>

                                </div>
                            </div>
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <jet-button style="margin-right: 10px">
                                    返回列表
                                </jet-button>
                                <jet-button>
                                    保存
                                </jet-button>
                            </div>
                        </div>
                    </div>
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
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import RenderComponent from "@/Components/RenderComponent";
import JetButton from "@/Jetstream/Button";

export default {
    name: "ListFrom",
    components: {
        AppLayout,
        Menu,
        JetInput,
        JetLabel,
        RenderComponent,
        JetButton
    }
}
</script>

<style scoped>

</style>
