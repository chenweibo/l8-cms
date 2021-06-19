<template>
    <tr
        class="border-b border-gray-200 hover:bg-gray-100">
        <td class="py-3 px-6 text-left whitespace-nowrap">
            <div class="flex items-center">
                <span class="font-medium">{{ menu.id }}</span>
            </div>
        </td>
        <td class="py-3 px-6 text-left">
            <div class="truncate font-normal" style="width: 200px"><span v-html="spacing"></span><i v-if="isHas"
                                                                                                    class="el-icon-arrow-down"></i>
                {{ menu.name }}
            </div>
        </td>
        <td class="py-3 px-6 text-left">
            <el-input v-model="menu.redirect" placeholder="重定向"
                      style="width: 8em;"
                      @change="((val)=>{reditChange(val, menu)})"></el-input>
        </td>
        <td class="py-3 px-6 text-left">
            {{ menu.url }}
        </td>
        <td class="py-3 px-6 text-center">
            <el-input v-model="menu.sort" class="text-center" placeholder=""
                      style="width: 50px; padding: 0;"
                      @change="((val)=>{sortChange(val, menu)})"></el-input>
        </td>

        <td class="py-3 px-6 text-center">
            <div class="flex items-center justify-center">
                <img
                    :src="handleDetail(menu.detail)"
                    class="w-6 h-6 rounded-full border-gray-200 border transform hover:scale-125"/>
            </div>
        </td>

        <td class="py-3 px-6 text-center">
            <el-switch
                v-model="menu.status"
                @change="statusChange($event,menu)"
            >
            </el-switch>
        </td>

        <td class="py-3 px-6 text-left font-normal">
            {{ categoryType.filter(i => i.value === menu.type)[0].label }}
        </td>
        <td class="py-3 px-6 text-center">
            <div class="flex item-center justify-center">
                <div class="flex inline-flex mr-2" role="group">
                    <inertia-link :href="route('categories.edit',menu.id)">
                        <button
                            class="focus:outline-none text-white text-sm py-1.5 px-2.5 bg-gray-500 rounded-l-md hover:bg-gray-600 hover:shadow-lg"
                            type="button">
                            编辑
                        </button>
                    </inertia-link>
                    <inertia-link
                        :href="route('categories.create',
                                              {'parent_id':menu.id,'url':menu.url,'type':menu.type,'columnTemplate':menu.columnTemplate,'contentTemplate':menu.contentTemplate,'page':menu.page})">

                        <button
                            class="focus:outline-none text-white text-sm py-1.5 px-2.5 bg-gray-700 hover:bg-gray-900 hover:shadow-lg"
                            type="button">
                            添加子分类
                        </button>
                    </inertia-link>
                    <button
                        class="focus:outline-none text-white text-sm py-1.5 px-2.5 bg-red-500 hover:bg-red-600 rounded-r-md  hover:shadow-lg"
                        @click="openDelete(menu)"
                    >
                        删除
                    </button>
                </div>
            </div>
        </td>
    </tr>

    <template v-if="menu.children && menu.children.length">
        <template v-for="(cmenu,k) in menu.children" :key="cmenu.id">
            <SubLi :level='level + 1' :menu="cmenu"/>
        </template>
    </template>
    <ConfirmationModal :show="show">
        <template #title>
            删除栏目
        </template>

        <template #content>
            是否确定删除栏目,不可恢复。
        </template>
        <template #footer>
            <jet-secondary-button @click="show = null">
                取消
            </jet-secondary-button>

            <jet-danger-button class="ml-2 " @click="handleDelete">
                确定
            </jet-danger-button>
        </template>
    </ConfirmationModal>

</template>

<script>
import {categoryType} from "@/Utils/Index.js";
import ConfirmationModal from '@/Jetstream/ConfirmationModal'
import JetDangerButton from "@/Jetstream/DangerButton";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";

export default {
    name: "SubLi",
    props: {
        menu: {
            type: Object,
            required: true
        },
        level: {
            type: Number,
            default: 0
        }
    },
    components: {
        ConfirmationModal,
        JetDangerButton,
        JetSecondaryButton,
    },
    data() {
        return {
            show: false,
            tempId: undefined,
            categoryType: categoryType,
        }
    },
    computed: {
        isHas: function () {
            return this.menu.children && this.menu.children.length
        },
        spacing: function () {
            let str = ''
            for (var i = 0; i < this.level; i++) {
                str = str + "&nbsp;&nbsp;&nbsp;";
            }
            return str
        },
    },
    methods: {
        handleDetail(arr) {
            if (arr.length > 0) {
                let url = ''
                _.forEach(arr, function (value, index) {
                    if (value.column === "img") {
                        url = value.value
                        return;

                    }
                })
                return url ? url : '/static/common/none.png';

            } else {
                return '/static/common/none.png';
            }

        },
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
            console.log()
            let id = row.id

            this.$inertia.put(route('categories.updateRedirect', id), {id: id, redirect: val})
        },
        openDelete(item) {
            //console.log(item)
            this.tempId = item.id
            this.show = true

        },
        handleDelete() {
            //console.log(this.tempId)
            this.$inertia.delete(route('categories.destroy', this.tempId))
            this.show = false
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

.cell {
    padding-left: 1em;
}
</style>
