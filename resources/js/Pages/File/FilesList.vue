<template>
    <div>
        <el-breadcrumb separator-class="el-icon-arrow-right">
            <el-breadcrumb-item>当前位置</el-breadcrumb-item>
            <el-breadcrumb-item style="cursor: pointer;" @click.native="toRoot">根目录</el-breadcrumb-item>
            <el-breadcrumb-item @click.native="toLinkPath(v,k)" style="cursor: pointer;" v-for="(v,k) in handlePath"
                                :key="k">
                {{ v }}
            </el-breadcrumb-item>
        </el-breadcrumb>
        <el-divider></el-divider>

        <div class="mb-6">
            <el-dropdown size="mini">
                <el-button type="primary" size="mini" style="margin-right: 10px">
                    新建<i class="el-icon-arrow-down el-icon--right"></i>
                </el-button>
                <template #dropdown>
                    <el-dropdown-menu>
                        <el-dropdown-item @click="mkdir">新建文件夹</el-dropdown-item>
                        <el-dropdown-item @click="mkfile">新建文件</el-dropdown-item>
                    </el-dropdown-menu>
                </template>
            </el-dropdown>
            <el-button type="primary" size="mini" @click="fileDialogVisible = true"
            >上传<i class="el-icon-upload el-icon--right"></i
            ></el-button>
            <el-button type="primary" @click="refreshNow" size="mini" icon="el-icon-refresh"></el-button>
        </div>

        <div class="w-full mt-1">
            <table class="w-full">
                <thead>
                <tr class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600">
                    <th class="px-4 py-3">文件名</th>
                    <th class="px-4 py-3">类型</th>
                    <th class="px-4 py-3">操作</th>
                </tr>
                </thead>
                <tbody class="bg-white">
                <!-- 文件目录渲染 -->
                <tr class="text-gray-700" v-for="(v,k) in dir" :key="k">

                    <td class="px-4 py-3 border">
                        <div class="flex items-center text-sm" @click="toPath(v)">
                            <div class="file_ico_type"><i class="dir_icon"></i>
                            </div>
                            <p class="font-semibold text-black file_title">{{ v }}</p>
                        </div>
                    </td>

                    <td class="px-4 py-3 text-ms font-semibold border">文件夹</td>

                    <td class="px-4 py-3 text-sm border">
                        <el-button type="text" @click="rename(v)">重命名</el-button>
                        <el-popconfirm
                            confirmButtonText="好的"
                            cancelButtonText="不用了"
                            icon="el-icon-info"
                            iconColor="red"
                            title="这是确定删除吗？"
                            @confirm="handleDelete('dir',v)"
                        >
                            <template #reference>
                                <el-button type="text">删除</el-button>
                            </template>
                        </el-popconfirm>
                    </td>

                </tr>
                <!--文件渲染-->
                <tr class="text-gray-700" v-for="(v,k) in files" :key="k">
                    <td class="px-4 py-3 border">
                        <div class="flex items-center text-sm">
                            <div class="file_ico_type">
                                <i :class="handleicon(v)"></i>
                            </div>
                            <p @click="openFileDialog(v)" class="font-semibold text-black file_title">{{ v }}</p>
                        </div>
                    </td>
                    <td class="px-4 py-3 text-ms font-semibold border">文件</td>

                    <td class="px-4 py-3 text-sm border">
                        <el-button @click="openFileDialog(v)" type="text" v-show="checkfile(v)">编辑</el-button>
                        <el-button type="text" @click="unzip(v)" v-show="v.split('.').pop()==='zip'">解压</el-button>
                        <el-button type="text" @click="rename(v)">重命名</el-button>
                        <el-popconfirm
                            confirmButtonText="好的"
                            cancelButtonText="不用了"
                            icon="el-icon-info"
                            iconColor="red"
                            title="这是确定删除吗？"
                            @confirm="handleDelete('files',v)"
                        >
                            <template #reference>
                                <el-button type="text">删除</el-button>
                            </template>
                        </el-popconfirm>
                        <a :href="down(v)" style="color: #3a8ee6;margin-left: 10px">下载</a>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

        <el-dialog
            :title="filename"
            v-model="dialogVisible"
            width="90%"
            destroy-on-close
        >
            <div class="min-h-full">
                <codeEditor v-model:value="code" scene="add" theme="ayu-mirage"></codeEditor>
            </div>

            <template #footer>
                <span class="dialog-footer">
                  <el-button @click="dialogVisible = false">取 消</el-button>
                  <el-button type="primary" @click="fileSave()">保存</el-button>
                </span>
            </template>

        </el-dialog>

        <el-dialog
            title="文件上传"
            v-model="fileDialogVisible"
            width="60%"
            destroy-on-close
        >

            <div class="min-h-full">
                <OtherUpload :disk="disk" :path="path" @refresh="refreshNow"/>
            </div>

        </el-dialog>

    </div>
</template>

<script>
import {conver} from "@/Utils/Index"
import codeEditor from '@/Components/Codemirror/codeEditor.vue'
import OtherUpload from '@/Components/Upload/OtherUpload.vue'

export default {
    name: "FilesList",
    components: {
        codeEditor,
        OtherUpload
    },
    props: {
        disk: {
            type: String,
            default: 'templates'
        }
    },
    data() {
        return {
            tableData: [],
            current: '',
            dir: [],
            files: [],
            loading: false,
            show: false,
            path: undefined,
            fullPath: undefined,
            code: '',
            dialogVisible: false,
            filename: '',
            fileDialogVisible: false
        }
    },
    created() {
        this.getData(this.disk, this.path)
    },
    mounted() {

    },
    computed: {
        handlePath() {
            if (this.path) {
                let arr = this.path.split('/')
                return _.compact(arr)
            }
            return []
        }
    },
    methods: {
        mkdir() {
            this.$prompt('请输入文件夹名称', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                inputPattern: /\S/,
                inputErrorMessage: '名称不能为空'
            }).then(({value}) => {
                axios.post(route('files.makeDirectory'), {
                    name: value,
                    disk: this.disk,
                    path: this.path,
                }).then(res => {

                    if (res.data.code !== 200) {
                        this.$notify({
                            title: '警告',
                            message: res.data.message,
                            type: 'warning'
                        });
                    } else {
                        this.getData(this.disk, this.path)
                    }
                })

            }).catch(() => {

            });
        },
        mkfile() {
            this.$prompt('请输入文件名称(注意带后缀 例 xx.txt)', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                inputPattern: /\S/,
                inputErrorMessage: '名称不能为空'
            }).then(({value}) => {
                axios.post(route('files.makeFile'), {
                    name: value,
                    disk: this.disk,
                    path: this.path,
                }).then(res => {

                    if (res.data.code !== 200) {
                        this.$notify({
                            title: '警告',
                            message: res.data.message,
                            type: 'warning'
                        });
                    } else {
                        this.getData(this.disk, this.path)
                    }
                })

            }).catch(() => {

            });
        },
        unzip(v) {
            const file = v

            this.$confirm('此操作将解压该文件到当前目录, 是否继续?', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                type: 'warning'
            }).then(() => {

                axios.post(route('files.unzip'), {

                    disk: this.disk,
                    path: this.path,
                    newName: file

                }).then(res => {

                    if (res.data.code === 200) {
                        this.getData(this.disk, this.path)
                        this.$message({
                            type: 'success',
                            message: '解压成功!'
                        });
                    } else {
                        this.$message({
                            type: 'info',
                            message: res.data.message
                        });
                    }


                })
            }).catch(() => {
                this.$message({
                    type: 'info',
                    message: '已取消删除'
                });
            });
        },
        rename(v) {
            this.$prompt('请输入新的名称', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                inputPattern: /^[0-9a-zA-Z\u4e00-\u9fa5\. ]+$/,
                inputErrorMessage: '只允许数字字母和中文和 . 符号'
            }).then(({value}) => {
                this.$message({
                    type: 'success',
                    message: '你的邮箱是: ' + value
                });
            }).catch(() => {

            });
        },
        down(v) {
            const disk = this.disk
            const file = this.path + '/' + v

            return route('uploads.download', disk) + file
        },
        toRoot() {
            this.getData(this.disk, '')
        },
        refreshNow() {
            this.getData(this.disk, this.path)
        },
        toLinkPath(v, k) {
            const path = _.dropRight(this.handlePath, this.handlePath.length - (k + 1))
            this.getData(this.disk, '/' + _.join(path, '/'))
        },
        selectRow(selection, row) {
            //console.log(selection, row)
        },
        fileSave() {

            axios.put(route('files.updatecontent'), {

                disk: this.disk,
                path: this.path + '/' + this.filename,
                content: this.code

            }).then(res => {

                this.dialogVisible = false
                this.code = ''

            })
            // console.log(this.code)
        },
        openFileDialog(filename) {
            this.filename = filename
            this.code = ''

            const ex = filename.split('.').pop()
            if (ex.indexOf(['jpeg', "jpg", "png"]) === 1) {
                this.$notify({
                    title: '警告',
                    message: '不支持编辑此格式',
                    type: 'warning'
                });
                return;
            }

            axios.get(route('files.getcontent'), {
                params: {
                    disk: this.disk,
                    path: this.path + '/' + filename,
                }
            }).then(res => {

                if (res.data.code === 201) {
                    this.$message(res.data.message)
                } else {
                    this.dialogVisible = true
                    this.code = res.data.data
                    // console.log(this.code)
                }

            })
            //this.dialogVisible = true
        },
        handleDelete(type, v) {

            const handleType = type === 'dir' ? 'dir' : 'files'


            axios.delete(route('files.delete'), {
                params: {
                    disk: this.disk,
                    path: this.path + '/' + v,
                    type: handleType
                }
            }).then(res => {
                this.getData(this.disk, this.path)
            })

        },
        selectAll(selection) {
            //console.log(selection)
        },
        getData(disk, path) {
            this.loading = true
            axios.get(route('files.templates'), {
                params: {
                    disk: disk,
                    path: path
                }
            }).then(res => {
                this.loading = false
                this.dir = res.data.dir
                this.files = res.data.files
                this.path = res.data.path
            })
        },
        handleSize(val) {
            if (val) {
                return conver(val)
            } else {
                return '文件夹'
            }

        },
        toPath(row) {

            this.getData(this.disk, this.path + '/' + row)

        },
        handleicon(v) {
            const ex = v.split('.').pop()

            switch (ex) {
                case 'zip': {
                    return 'zip_icon'
                }

                default: {
                    return 'file_icon'
                }
            }
        },
        checkfile(v) {
            const ex = v.split('.').pop()
            const arr = ['zip']

            return arr.indexOf(ex);
        },
        openMakeDir() {

            const that = this

            this.$prompt('请输入文件夹名称', '提示', {
                confirmButtonText: '确定',
                cancelButtonText: '取消',
                inputPattern: /\S/,
                inputErrorMessage: '名称不能为空',
                callback: function (action, instance) {
                    if (action === 'confirm') {
                        axios.get(route('files.makeDirectory'), {
                            params: {
                                path: that.fullPath + '/' + instance.inputValue,
                            }
                        }).then(res => {
                            //console.log(res.data.code)
                            if (res.data.code !== 200) {
                                that.$notify({
                                    title: '警告',
                                    message: res.data.message,
                                    type: 'warning'
                                });
                            } else {
                                that.getData(that.disk, that.path)
                            }
                        })
                    }
                }
            })
        }

    }
}
</script>

<style lang="scss">
.el-dropdown {
    vertical-align: top;
}

.el-dropdown + .el-dropdown {
    margin-left: 15px;
}

.el-icon-arrow-down {
    font-size: 12px;
}

.file_ico_type {
    height: 40px;
    line-height: 40px;
    display: inline-block;
    position: relative;
}

.file_icon {
    width: 30px;
    height: 30px;
    position: absolute;
    top: 7.5px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    image-rendering: -webkit-optimize-contrast;
    background-image: url('../../Images/file.png');
    cursor: pointer;
}

.box span {
    font-size: 12px;
    cursor: pointer;
}

.dir_icon {
    width: 30px;
    height: 30px;
    position: absolute;
    top: 7.5px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    image-rendering: -webkit-optimize-contrast;
    background-image: url('../../Images/folder.png');
    cursor: pointer;
}

.zip_icon {
    width: 30px;
    height: 30px;
    position: absolute;
    top: 7.5px;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    image-rendering: -webkit-optimize-contrast;
    background-image: url('../../Images/zip.png');
    cursor: pointer;
}

.file_title {
    vertical-align: top;
    padding-left: 38px;
    box-sizing: border-box;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    display: inline-block;
    line-height: 47px;
    cursor: pointer;
}

//.el-dialog__body{
//    height: 60vh;
//}


</style>
