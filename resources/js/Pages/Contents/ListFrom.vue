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
                                        <jet-label for="mc" value="名称（ name ）"/>
                                        <jet-input id="name" autocomplete="名称" v-model="form.name" class="mt-1 block w-full" type="text"/>
                                    </div>
                                    <div class="flex col-span-6 sm:col-span-4">
                                        <div class="mr-10 col-span-6 sm:col-span-4">
                                            <jet-label for="mc" value="所属"/>
                                            <div class="mt-1 ">
                                                <span class="inline-block bg-gray-50 px-3 py-2.5 text-sm shadow-sm font-medium tracking-wider border text-gray-600 rounded ">{{$page.props.title}}</span>
                                            </div>

                                        </div>
                                        <div class="mr-10 col-span-6 sm:col-span-4">
                                            <jet-label for="mc" value="排序（ sort ）"/>
                                            <jet-input id="sort" v-model="form.sort" autocomplete="浏览量" class="mt-1 block w-20" type="text"/>
                                        </div>
                                        <div class="mr-10 col-span-6 sm:col-span-4">
                                            <jet-label for="mc" value="浏览量（ views ）"/>
                                            <jet-input id="views" v-model="form.views" autocomplete="浏览量" class="mt-1 block w-20" type="text"/>
                                        </div>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="mc" value="重定向（ redirect ）"/>
                                        <jet-input id="redirect" autocomplete="重定向" v-model="form.redirect" class="mt-1 block w-full" type="text"/>
                                    </div>
                                    <RenderComponent v-model:content="mergeContent"/>


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
    },
    data() {
        return {
            form: {
                id: undefined,
                name: undefined,
                detail: {},
                sort: 0,
                views:0,
                redirect: ''
            },
            component: this.$page.props.component,
        }
    },
    computed: {
        mergeContent() {
            const arr = []
            const that = this
            if (this.component.length > 0) {
                _.forEach(this.component, function (value, index) {//这里规定的就是第一个参数返回的是value值，第二个参数是下标index
                    const id = _.findIndex(that.form.detail, function (o) {
                        return o.column == value.column;
                    });
                    if (id != -1) {
                        arr.push(that.form.detail[id])
                    } else {
                        arr.push(value)
                    }
                });
                return arr
            }
        },

        handleViewList() {

            if (this.viewList) {
                return this.viewList.filter(item => item !== '.' && item !== '..')
            }
            return [];
        }
    },

}
</script>

<style scoped>

</style>
