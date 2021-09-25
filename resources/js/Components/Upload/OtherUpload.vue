<template>
    <div class="example-simple">
        <div class="upload">
            <div class="example-btn">
                <file-upload
                    class="btn btn-primary"
                    :post-action="route('uploads.up')"
                    :headers="{'X-CSRF-TOKEN': $page.props.csrf_token}"
                    :data="{disk: disk,path:path}"
                    extensions="gif,jpg,jpeg,png,webp,zip"
                    accept="image/png,image/gif,image/jpeg,image/webp,application/x-zip-compressed"
                    :multiple="true"
                    :size="1024 * 1024 * 10"
                    v-model="files"
                    @input-filter="inputFilter"
                    @input-file="inputFile"
                    ref="upload">
                    <el-button size="mini">选择文件</el-button>
                </file-upload>
            </div>
                <div class="upload_file_body">
                    <ul>
                        <li v-for="file in files" :key="file.id">
                            <span>{{file.name}}</span> -
                            <span>{{ formatSize(file.size) }}</span> -
                            <span v-if="file.error">{{file.error}}</span>
                            <span v-else-if="file.success">成功</span>
                            <span v-else-if="file.active">正在上传</span>
                            <span v-else-if="!!file.error">{{file.error}}</span>
                            <span v-else></span>
                        </li>
                    </ul>
                </div>
            <div class="upload-btn">
                <el-button size="mini" style="margin-left: 10px"  type="primary" v-if="!upload || !upload.active" @click.prevent="upload.active = true" >开始上传</el-button>
                <el-button size="mini"  v-else @click.prevent="upload.active = false" type="primary">停止上传</el-button>
            </div>
        </div>

    </div>
</template>
<style>
.example-simple label.btn {
    margin-bottom: 0;
    margin-right: 1rem;
}
</style>

<script>
import {ref, reactive } from 'vue'
import FileUpload from 'vue-upload-component'
export default {
    components: {
        FileUpload,
    },
    props: {
        disk: String,
        path:String
    },
    name:'otherUpload',
    setup(props, context) {

        const upload = ref(null)

       // const uploadurl = reactive(route('uploads.up',{disk:props.disk,path:props.path}))
        const  disk = props.disk
        const  path = props.path


        const files = ref([])

        function inputFilter(newFile, oldFile, prevent) {
            if (newFile && !oldFile) {
                // Before adding a file
                // 添加文件前

                // Filter system files or hide files
                // 过滤系统文件 和隐藏文件
                if (/(\/|^)(Thumbs\.db|desktop\.ini|\..+)$/.test(newFile.name)) {
                    return prevent()
                }

                // Filter php html js file
                // 过滤 php html js 文件
                if (/\.(php5?|html?|jsx?)$/i.test(newFile.name)) {
                    return prevent()
                }
            }
        }
        function formatSize(size) {
            if (size > 1024 * 1024 * 1024 * 1024) {
                return (size / 1024 / 1024 / 1024 / 1024).toFixed(2) + ' TB'
            } else if (size > 1024 * 1024 * 1024) {
                return (size / 1024 / 1024 / 1024).toFixed(2) + ' GB'
            } else if (size > 1024 * 1024) {
                return (size / 1024 / 1024).toFixed(2) + ' MB'
            } else if (size > 1024) {
                return (size / 1024).toFixed(2) + ' KB'
            }
            return size.toString() + ' B'
        }

        function inputFile(newFile, oldFile) {
            if (newFile && !oldFile) {
                // add
                //console.log('add', newFile)
            }
            if (newFile && oldFile) {
                // update
               // console.log('update', newFile)
                context.emit("refresh")
            }

            if (!newFile && oldFile) {
                // remove
                //console.log('remove', oldFile)
            }
        }

        return {
            files,
            upload,
            inputFilter,
            inputFile,
            formatSize,
            disk,
            path
        }
    }
}
</script>

<style>

.example-btn{
    display: flex;
}
.example-simple{
    min-height: 300px;
}
.upload_file_body{
    height: 250px;
    border: 2px dashed #e0e0e0;
    margin-top: 20px;
    padding: 10px;
}
.upload-btn{
    margin-top: 20px;
    display: flex;
}
</style>
