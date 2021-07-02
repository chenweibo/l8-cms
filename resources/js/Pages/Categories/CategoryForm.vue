<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $page.isEdit ? '编辑类目' : '创建类目' }}
            </h2>
        </template>
        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="flex flex-row justify-end">
                </div>
                <div class="md:grid md:grid-cols-3 md:gap-6 mt-10 ">
                    <jet-section-title>
                        <template #title>
                            <slot name="title">类目信息</slot>
                        </template>
                        <template #description>
                            <slot name="description">填写您的网站类目信息。</slot>
                            <br>
                        </template>
                    </jet-section-title>
                    <div class="mt-5 md:mt-0 md:col-span-2 min-h-200">
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="mc" value="名称 ( name )"/>
                                        <jet-input id="mc" v-model="form.name" autocomplete="名称"
                                                   class="mt-1 block w-full"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.name" class="mt-2"/>

                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="lx" value="类型选择( 常规：正常为还有子目录的顶级类目 )"/>
                                        <el-radio-group v-model="form.type" class="mt-2" size="mini"
                                                        v-bind:disabled="isEdit">
                                            <el-radio-button v-for="(v,k) in categoryType" :key="k"  :label="v.value">
                                                {{ v.label }}
                                            </el-radio-button>
                                        </el-radio-group>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="redirect" value="重定向 ( redirect )"/>
                                        <jet-input id="redirect" v-model="form.redirect" autocomplete="重定向"
                                                   class="mt-1 block w-full"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.redirect" class="mt-2"/>

                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="url" value="访问路径 ( 自定义访问地址，头部不需要添加'/'  ) "/>
                                        <jet-input id="url" v-model="form.url" autocomplete="地址"
                                                   class="mt-1 block w-full"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.url" class="mt-2"/>
                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="columnTemplate" value="栏目模版"/>
                                        <el-select v-model="form.columnTemplate" class="mt-2" placeholder="请选择栏目模版"
                                                   style="width:100%">
                                            <el-option
                                                v-for="(v,k) in handleViewList"
                                                :key="k"
                                                :label="v"
                                                :value="v">
                                            </el-option>
                                        </el-select>
                                        <jet-input-error :message="$page.props.errors.columnTemplate" class="mt-2"/>

                                    </div>

                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="contentTemplate" value="内容模版( 类型不需要内容模版可不填 )"/>
                                        <el-select v-model="form.contentTemplate" class="mt-2" placeholder="请选择内容模版"
                                                   style="width:100%">
                                            <el-option
                                                v-for="(v,k) in handleViewList"
                                                :key="k"
                                                :label="v"
                                                :value="v">
                                            </el-option>
                                        </el-select>
                                        <jet-input-error :message="$page.props.errors.contentTemplate" class="mt-2"/>

                                    </div>

                                    <div v-show="form.type==='3'" class="col-span-6 sm:col-span-4">
                                        <jet-label for="url" value="控制器( 需要提前写好 )"/>
                                        <jet-input id="controller" v-model="form.controller" autocomplete="控制器"
                                                   class="mt-1 block w-full"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.controller" class="mt-2"/>
                                    </div>
                                    <div v-show="form.type==='3'" class="col-span-6 sm:col-span-4">
                                        <jet-label for="function" value="方法( 需要提前写好 )"/>
                                        <jet-input id="function" v-model="form.function" autocomplete="方法"
                                                   class="mt-1 block w-full"
                                                   type="text"/>
                                        <jet-input-error :message="$page.props.errors.function" class="mt-2"/>
                                    </div>
                                    <div class="col-span-6 sm:col-span-4">
                                        <jet-label for="page" value="分页数 ( 使用列表页时生效  ) 默认10"/>
                                        <jet-input id="page" v-model="form.page" autocomplete="分页数"
                                                   class="mt-1 block w-full"
                                                   type="text"/>
                                    </div>

                                    <RenderComponent v-model:content="mergeContent"/>
                                </div>
                            </div>
                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <el-button size="small" type="info" @click="save">保存</el-button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import JetSectionTitle from "@/Jetstream/SectionTitle";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetInputError from "@/Jetstream/InputError";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";

import {ElRadioButton, ElRadioGroup, ElSelect, ElOption, ElCascader,} from 'element-plus'

import {categoryType} from '@/Utils/Index'
import RenderComponent from '@/Components/RenderComponent'


export default {
    name: "CategoryForm",
    components: {
        AppLayout,
        JetSecondaryButton,
        JetSectionTitle,
        JetInput,
        JetLabel,
        JetInputError,
        JetActionMessage,
        JetButton,
        ElRadioButton,
        ElRadioGroup,
        ElSelect,
        ElOption,
        ElCascader,
        RenderComponent

    },
    data() {
        return {
            isEdit: this.$page.props.isEdit,
            categoryList: this.$page.props.categoryList,
            viewList: this.$page.props.viewList,
            categoryType: categoryType,
            component: this.$page.props.component,
            form: {
                name: '',
                parent_id: 0,
                sort: 0,
                status: 1,
                type: 0,
                url: '',
                page: 10,
                detail: {},
                controller: '',
                function: '',
                contentTemplate: '',
                columnTemplate: '',
                redirect: ''
            },
            normalizer(node) {
                return {
                    id: node.id,
                    label: node.name,
                    children: node.children,
                }
            }
            // error:this.$page.error,
        }
    },
    computed: {
        handleCategoryList() {
            this.categoryList.unshift({id: 0, name: '顶级分类'})
            return this.categoryList;
        },
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
    created() {
        if (this.isEdit) {
            this.form = this.$page.props.category
            if (!this.form.parent_id) {
                this.form.parent_id = 0
            }

        } else {

            this.form.parent_id = this.$page.props.params.parent_id ? this.$page.props.params.parent_id : 0
            this.form.type = this.$page.props.params.type ? this.$page.props.params.type : 0
            this.form.url = this.$page.props.params.url
            this.form.columnTemplate = this.$page.props.params.columnTemplate
            this.form.contentTemplate = this.$page.props.params.contentTemplate
            this.form.page = this.$page.props.params.page ? this.$page.props.params.page : 10

            console.log(this.form.parent_id)
        }


    },
    methods: {
        handleChange(value) {
        },
        save() {
            this.form.detail = this.mergeContent;
            if (this.isEdit) {

                this.$inertia.put(route('categories.update', this.form.id), this.form)

            } else {
                this.$inertia.post(route('categories.store'), this.form)
            }
        }
    }
}
</script>

<style scoped>

</style>
