<template>
    <div class="col-span-6 sm:col-span-4">
        <jet-label :value="content.label" for="content.label"/>
        <div class="col-span-6 sm:col-span-4 ">

            <div class="flex flex-row  mt-2">
                <file-upload
                    ref="upload"
                    v-model="files"
                    :multiple="true"
                    :size="1024 * 1024 * 10"
                    class="transition duration-300 ease-in-out mr-1 mb-1 py-2 px-4 bg-purple-700 rounded text-white font-normal focus:outline-none focus:shadow-outline hover:bg-purple-900"
                    extensions="gif,jpg,jpeg,png,webp,pdf"
                    post-action="/files/upload"
                    @input-filter="inputFilter"
                    @input-file="inputFile">
                    <i class="fa fa-plus"></i>
                    选择文件
                </file-upload>
                <button v-if="!upload || !upload.active"
                        class="transition duration-300 ease-in-out mr-1 mb-1 py-2 px-4 bg-purple-700 rounded text-white font-normal focus:outline-none focus:shadow-outline hover:bg-purple-900"
                        type="button"
                        @click.prevent="upload.active = true">
                    开始上传
                </button>
            </div>

            <ul>
                <li v-for="file in files" :key="file.id">
                    <span>{{ file.name }}</span> -
                    <span>{{ formatSize(file.size) }}</span> -
                    <span v-if="file.error">{{ file.error }}</span>
                    <span v-else-if="file.success">success</span>
                    <span v-else-if="file.active">active</span>
                    <span v-else-if="!!file.error">{{ file.error }}</span>
                    <span v-else></span>
                </li>
            </ul>

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
import {ref,watch,toRefs} from 'vue'
import FileUpload from 'vue-upload-component'
import JetLabel from "@/Jetstream/Label";

export default {
    components: {
        FileUpload,
        JetLabel
    },
    props: {
        content: {
            type: Object,
            default: function () {
                return {
                    id: undefined,
                    value: [],
                    label: '',
                    column: '',
                    note: []
                }
            }
        }
    },
    setup(props, context) {
        const upload = ref(null)



        const { content } = toRefs(props)


        //console.log(content.value.value)


        if (!Array.isArray(content.value.value)) {
            const files = ref([])
        }else {
            const files = content.value.value
        }

        const files = ref([])


        watch(files, (newValue, oldValue) => {

           const arr =  _.filter(newValue, function(o) { return o.success ==true; });
            console.log('The new counter value is: ' +JSON.stringify(arr) )

        })

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
               // console.log('add', newFile)
            }
            if (newFile && oldFile) {
                // update
               // console.log('update', newFile)
            }
            if (!newFile && oldFile) {
                // remove
              //  console.log('remove', oldFile)
            }
        }

        return {
            files,
            upload,
            inputFilter,
            inputFile,
            formatSize
        }
    }
}
</script>
