<template>
    <div class="col-span-8 sm:col-span-6">
        <div>
            <jet-label for="basic_s" value="富文本编辑器"/>
            <div :class="{fullscreen:fullscreen}" :style="{width:containerWidth}" class="tinymce-container mt-2">
                <textarea :id="tinymceId" class="tinymce-textarea"/>
                <!--    <div class="editor-custom-btn-container">-->
                <!--      <editorImage color="#1890ff" class="editor-upload-btn" @successCBK="imageSuccessCBK" />-->
                <!--    </div>-->
                <LabelInfo v-model:note="note" :id="content.id" class="mt-3"/>
            </div>
        </div>
    </div>

</template>

<script>
/**
 * docs:
 * https://panjiachen.github.io/vue-element-admin-site/feature/component/rich-editor.html#tinymce
 */
//import editorImage from './components/EditorImage'
import plugins from '@/Components/Tinymce/plugins.js'
import toolbar from '@/Components/Tinymce/toolbar.js'
import load from '@/Components/Tinymce/dynamicLoadScript.js'

// why use this cdn, detail see https://github.com/PanJiaChen/tinymce-all-in-one
const tinymceCDN = 'https://cdn.jsdelivr.net/npm/tinymce-all-in-one@4.9.3/tinymce.min.js'
import LabelInfo from '@/Components/LabelInfo'
import JetLabel from "@/Jetstream/Label";

export default {
    name: 'Tinymce',
    components: {LabelInfo, JetLabel},
    emits: ['update:content'],
    props: {
        id: {
            type: String,
            default: function () {
                return 'vue-tinymce-' + +new Date() + ((Math.random() * 1000).toFixed(0) + '')
            }
        },
        modelValue: {
            type: String,
            default: ''
        },
        toolbar: {
            type: Array,
            required: false,
            default() {
                return []
            }
        },
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
        },
        menubar: {
            type: String,
            default: 'file edit insert view format table'
        },
        height: {
            type: [Number, String],
            required: false,
            default: 360
        },
        width: {
            type: [Number, String],
            required: false,
            default: 'auto'
        }
    },
    data() {
        return {
            note: this.content.note,
            hasChange: false,
            hasInit: false,
            tinymceId: this.id,
            fullscreen: false,
            languageTypeList: {
                'en': 'en',
                'zh': 'zh_CN',
                'es': 'es_MX',
                'ja': 'ja'
            }
        }
    },
    computed: {
        containerWidth() {
            const width = this.width
            if (/^[\d]+(\.[\d]+)?$/.test(width)) { // matches `100`, `'100'`
                return `${width}px`
            }
            return width
        }
    },
    watch: {
        content:{
            handler(new_value,old_value){

                if (!this.hasChange && this.hasInit) {
                    this.$nextTick(() =>
                        window.tinymce.get(this.tinymceId).setContent(new_value.value || ''))
                }
                //console.log(new_value,old_value)
            },
            deep: true
        },
        value(val) {
            if (!this.hasChange && this.hasInit) {
                this.$nextTick(() =>
                    window.tinymce.get(this.tinymceId).setContent(val || ''))
            }
        }
    },
    mounted() {
        this.init()
    },
    activated() {
        if (window.tinymce) {
            this.initTinymce()
        }
    },
    deactivated() {
        this.destroyTinymce()
    },
    unmounted() {
        this.destroyTinymce()
    },
    methods: {
        init() {
            // dynamic load tinymce from cdn
            load(tinymceCDN, (err) => {
                if (err) {
                    this.$message.error(err.message)
                    return
                }
                this.initTinymce()
            })
        },
        initTinymce() {
            const _this = this
            window.tinymce.init({
                selector: `#${this.tinymceId}`,
                language: this.languageTypeList['zh'],
                // mobile: {
                //     menubar: true
                // },
                height: this.height,
                body_class: 'panel-body ',
                object_resizing: false,
                toolbar: this.toolbar.length > 0 ? this.toolbar : toolbar,
                menubar: this.menubar,
                plugins: plugins,
                end_container_on_empty_block: true,
                powerpaste_word_import: 'clean',
                code_dialog_height: 450,
                code_dialog_width: 1000,
                advlist_bullet_styles: 'square',
                advlist_number_styles: 'default',
                imagetools_cors_hosts: ['www.tinymce.com', 'codepen.io'],
                default_link_target: '_blank',
                link_title: false,
                nonbreaking_force_tab: true, // inserting nonbreaking space &nbsp; need Nonbreaking Space Plugin
                init_instance_callback: editor => {
                    if (_this.content.value) {
                        editor.setContent(_this.content.value)
                    }
                    _this.hasInit = true
                    editor.on('NodeChange Change KeyUp SetContent', () => {
                        this.hasChange = true
                        this.content.value = editor.getContent()
                        this.$emit('update:content', this.content)
                        //this.$emit('input', editor.getContent())
                    })
                },
                setup(editor) {
                    editor.on('FullscreenStateChanged', (e) => {
                        _this.fullscreen = e.state
                    })
                },
                // it will try to keep these URLs intact
                // https://www.tiny.cloud/docs-3x/reference/configuration/Configuration3x@convert_urls/
                // https://stackoverflow.com/questions/5196205/disable-tinymce-absolute-to-relative-url-conversions
                convert_urls: false,
                // 整合七牛上传
                // images_dataimg_filter(img) {
                //   setTimeout(() => {
                //     const $image = $(img);
                //     $image.removeAttr('width');
                //     $image.removeAttr('height');
                //     if ($image[0].height && $image[0].width) {
                //       $image.attr('data-wscntype', 'image');
                //       $image.attr('data-wscnh', $image[0].height);
                //       $image.attr('data-wscnw', $image[0].width);
                //       $image.addClass('wscnph');
                //     }
                //   }, 0);
                //   return img
                // },

                images_upload_handler(blobInfo, success, failure, progress) {
                    progress(0);

                    let forms = new FormData()

                    forms.append('file', blobInfo.blob())

                    axios.post(route('admin.upload'), forms).then(res => {
                        const filename = res.data.filename
                        const path = '/static/' + res.data.path
                        success(path);
                        progress(100);

                        // console.log(res)

                    }).catch(error => {
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

                    // const token = _this.$store.getters.token;
                    // getToken(token).then(response => {
                    //   const url = response.data.qiniu_url;
                    //   const formData = new FormData();
                    //   formData.append('token', response.data.qiniu_token);
                    //   formData.append('key', response.data.qiniu_key);
                    //   formData.append('file', blobInfo.blob(), url);
                    //   upload(formData).then(() => {
                    //     success(url);
                    //     progress(100);
                    //   })
                    // }).catch(err => {
                    //   failure('出现未知问题，刷新页面，或者联系程序员')
                    //   console.log(err);
                    // });
                },
            })
        },
        destroyTinymce() {
            const tinymce = window.tinymce.get(this.tinymceId)
            if (this.fullscreen) {
                tinymce.execCommand('mceFullScreen')
            }

            if (tinymce) {
                tinymce.destroy()
            }
        },
        setContent(value) {
            window.tinymce.get(this.tinymceId).setContent(value)
        },
        getContent() {
            window.tinymce.get(this.tinymceId).getContent()
        },
        imageSuccessCBK(arr) {
            arr.forEach(v => window.tinymce.get(this.tinymceId).insertContent(`<img class="wscnph" src="${v.url}" >`))
        }
    }
}
</script>

<style lang="scss" scoped>
.tinymce-container {
    position: relative;
    line-height: normal;
}

.tinymce-container {

    :deep(.mce-fullscreen) {
        z-index: 10000;
    }

}

.tinymce-textarea {
    visibility: hidden;
    z-index: -1;
}

.editor-custom-btn-container {
    position: absolute;
    right: 4px;
    top: 4px;
    /*z-index: 2005;*/
}

.fullscreen .editor-custom-btn-container {
    z-index: 10000;
    position: fixed;
}

.editor-upload-btn {
    display: inline-block;
}
</style>
