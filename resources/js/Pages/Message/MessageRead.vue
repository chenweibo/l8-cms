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
                    <el-descriptions title="留言内容">
                        <el-descriptions-item label="名称">{{ $page.props.content.name }}</el-descriptions-item>
                        <el-descriptions-item label="留言时间">{{ $page.props.content.created_at }}</el-descriptions-item>
                        <el-descriptions-item v-for="(v,k) in $page.props.content.detail " :key="k" :label="v.label">
                            {{ v.value }}
                        </el-descriptions-item>
                    </el-descriptions>
                </div>
            </div>
        </div>

    </app-layout>

</template>

<script>
import AppLayout from "@/Layouts/AppLayout";


export default {
    name: "messageList",
    components: {AppLayout}
}
</script>

<style scoped>

</style>
