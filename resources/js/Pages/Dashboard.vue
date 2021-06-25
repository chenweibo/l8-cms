<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                仪表盘
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="flex items-start justify-center min-h-screen pt-5 bg-white min-w-screen">
                        <div class="flex flex-wrap w-full px-4">
                            <div class="w-full mb-4 px-2 sm:w-1/2 xl:w-1/3">
                                <div
                                    class="relative flex items-center px-5 py-6 overflow-hidden rounded-md shadow-sm bg-gradient-to-br from-gray-100 to-gray-200">
                                    <span class="absolute top-0 left-0 w-2 h-full bg-gray-500"></span>
                                    <div class="p-3 rounded-full  bg-gray-700">
                                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"/>
                                        </svg>
                                    </div>
                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">10</h4>
                                        <div class="text-gray-500">管理员数量</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-4 px-2 sm:w-1/2 xl:w-1/3">
                                <div
                                    class="relative flex items-center px-5 py-6 overflow-hidden rounded-md shadow-sm bg-gradient-to-br from-gray-100 to-gray-200">
                                    <span
                                        class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-indigo-300 to-indigo-500"></span>
                                    <div
                                        class="p-3 bg-opacity-75 rounded-full bg-gradient-to-br from-indigo-400 to-indigo-600">

                                        <svg class="w-8 h-8 text-white" fill="none"
                                             stroke="currentColor" viewBox="-2 0 28 26" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"/>
                                        </svg>
                                    </div>
                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">10</h4>
                                        <div class="text-gray-500">单篇文章</div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full mb-4 px-2 mt-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                                <div
                                    class="relative flex items-center px-5 py-6 overflow-hidden rounded-md shadow-sm bg-gradient-to-br from-gray-100 to-gray-200">
                                    <span
                                        class="absolute top-0 left-0 w-2 h-full bg-gradient-to-b from-pink-300 to-pink-500"></span>
                                    <div
                                        class="p-3 bg-opacity-75 rounded-full bg-gradient-to-br from-pink-400 to-pink-600">
                                        <svg class="w-8 h-8 text-white" fill="none" viewBox="0 0 28 28"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path d="M6.99998 11.2H21L22.4 23.8H5.59998L6.99998 11.2Z"
                                                  fill="currentColor"
                                                  stroke="currentColor" stroke-linejoin="round" stroke-width="2"/>
                                            <path
                                                d="M9.79999 8.4C9.79999 6.08041 11.6804 4.2 14 4.2C16.3196 4.2 18.2 6.08041 18.2 8.4V12.6C18.2 14.9197 16.3196 16.8 14 16.8C11.6804 16.8 9.79999 14.9197 9.79999 12.6V8.4Z"
                                                stroke="currentColor" stroke-width="2"/>
                                        </svg>
                                    </div>
                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">20</h4>
                                        <div class="text-gray-500">列表内容</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-4 px-2 mt-6 sm:w-1/2 xl:w-1/3 sm:mt-0">
                                <div
                                    class="relative flex items-center px-8 py-6 overflow-hidden rounded-md shadow-sm bg-gradient-to-br from-gray-100 to-gray-200">
                                    <span class="absolute top-0 left-0 w-2 h-full bg-green-400"></span>
                                    <div class="p-3  rounded-full bg-green-400">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"/>
                                        </svg>
                                    </div>
                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">900</h4>
                                        <div class="text-gray-500">留言</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-4 px-2 sm:w-1/2 xl:w-1/3">
                                <div
                                    class="relative flex items-center px-5 py-6 overflow-hidden rounded-md shadow-sm bg-gradient-to-br from-gray-100 to-gray-200">
                                    <span class="absolute top-0 left-0 w-2 h-full bg-red-600"></span>
                                    <div class="p-3  rounded-full bg-red-600">
                                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"/>
                                        </svg>
                                    </div>
                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">10</h4>
                                        <div class="text-gray-500">未读留言</div>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full mb-4 px-2 sm:w-1/2 xl:w-1/3">
                                <div
                                    class="relative flex items-center px-5 py-6 overflow-hidden rounded-md shadow-sm bg-gradient-to-br from-gray-100 to-gray-200">
                                    <span class="absolute top-0 left-0 w-2 h-full bg-black"></span>
                                    <div class="p-3  rounded-full bg-black">
                                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor"
                                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"/>
                                        </svg>

                                    </div>
                                    <div class="mx-5">
                                        <h4 class="text-2xl font-semibold text-gray-700">10</h4>
                                        <div class="text-gray-500">自定义组件</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'
import Welcome from '@/Jetstream/Welcome'

export default {
    components: {
        AppLayout,
        Welcome,
    },
}
</script>
