<template>
    <app-layout>
        <div class="flex-col w-full md:flex md:flex-row md:min-h-screen bg-blueGray-50">


            <div class="flex flex-col w-64 h-screen px-4  bg-white border-r dark:bg-gray-800 dark:border-gray-600">

                <div class="flex flex-col justify-between flex-1 mt-6">
                    <nav>
                        <Menu  v-for="menu in $page.props.menu" :model="menu"/>
                    </nav>

                </div>
            </div>
            <div class="flex-grow   py-10 sm:px-6 lg:px-8 ">

                <div class="p-8 md:min-h-screen mt-5 md:mt-0 bg-white md:col-span-2 border-none border-4 border-gray-600 rounded-lg ">
                    <component v-bind:is="$page.props.component"></component>
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
    methods:{
        changeMenu(){

        }
    }
}
</script>

<style scoped>

</style>
