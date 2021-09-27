<template>

    <div class="col-span-6 sm:col-span-4">

        <div class="col-span-6 sm:col-span-4">
            <jet-label :for="content.column" :value="content.label+' ( '+ content.column+' )'"/>
            <div class="mt-2">
                <el-upload
                    :post-action="route('uploads.up')"
                    :headers="{'X-CSRF-TOKEN': $page.props.csrf_token}"
                    :file-list="handleList"
                    :on-change="handleChange"
                    action="#"
                    list-type="picture-card">
                    <template #default>
                        <i class="el-icon-plus"></i>
                    </template>
                    <template #file="{file}">
                        <div>
                            <img :src="file.url" alt="" class="el-upload-list__item-thumbnail"/>
                            <span class="el-upload-list__item-actions">
          <span
              class="el-upload-list__item-preview"
              @click="handlePictureCardPreview(file)"
          >
            <i class="el-icon-zoom-in" @click="bigImg"></i>
          </span>
          <span
              v-if="!disabled"
              class="el-upload-list__item-delete"
              @click="handleDownload(file)"
          >
            <i class="el-icon-download"></i>
          </span>
          <span
              v-if="!disabled"
              class="el-upload-list__item-delete"
              @click="handleRemove(file)"
          >
            <i class="el-icon-delete"></i>
          </span>
        </span>
                        </div>
                    </template>
                </el-upload>
                <el-dialog v-model="dialogVisible">
                    <el-image :src="dialogImageUrl" fit="fill"></el-image>
                </el-dialog>
            </div>
            <LabelInfo :id="content.id" :note.sync="note" class="mt-3"/>
        </div>
    </div>
</template>
<script>
import LabelInfo from '@/Components/LabelInfo'
import JetLabel from "@/Jetstream/Label";

export default {
    name: 'MultiUpload',
    components: {LabelInfo, JetLabel},
    props: {
        content: {
            type: Object,
            default: function () {
                return {
                    id: undefined,
                    value: undefined,
                    label: '',
                    column: '',
                    note: []
                }
            }
        }
    },
    computed: {
        handleList() {
            if (!Array.isArray(this.list)) {
                return []
            } else {
                return this.list
            }
        }
    },
    data() {
        return {
            dialogImageUrl: '',
            dialogVisible: false,
            disabled: false,
            note: this.content.note,
            list: this.content.value
        }
    },
    watch: {
        note: {
            handler(new_value, old_value) {
                this.content.note = new_value
            },
            deep: true
        },
        list: {
            handler(new_value, old_value) {

                this.content.value = new_value
            },
            deep: true
        }
    },
    methods: {
        handleRemove(file) {
            const index = _.findIndex(this.list, function (o) {
                return o.name == file.name;
            });
            this.list.splice(index, 1);

        },
        handlePictureCardPreview(file) {
            //console.log(file)
            this.dialogImageUrl = file.url;
            this.dialogVisible = true;
        },
        handleDownload(file) {
            window.open('http://'+window.location.host+file.url, '_blank');

        },
        handleChange(file, fileList) {

            let forms = new FormData()

            forms.append('file', file.raw)

            axios.post(route('files.upload'), forms).then(res => {
                const filename = res.data.filename
                const path = '/static/' + res.data.path
                //深拷贝消除抖动动画
                // let arr = JSON.parse(JSON.stringify(this.fileList))
                //arr.join({name:filename,url:path})
                //console.log(1)
                if (!Array.isArray(this.list)) {
                    this.list = []
                    this.list.push({name: filename, url: path})
                } else {
                    this.list.push({name: filename, url: path})
                }


            }).catch(error => {
                console.log(error)
                if (error.response.status == 419) {
                    this.$notify.error({
                        title: '错误',
                        message: '页面已经超时，请刷新后重试。'
                    });
                }

                if (error.response.status == 422) {
                    let str = error.response.data.message.replace(/\s+/g, "");
                    this.$notify.error({
                        title: '错误',
                        message: str
                    });
                }

            })
        },
    }
}
</script>
<style>

.el-upload-list__item {
    transition: none !important;
}

/* 推荐，实现简单 */
.el-upload-list__item.is-ready {
    display: none !important;
}

.el-upload-list__item.is-uploading {
    display: none !important;
}
</style>
