<template>
    <div class="md:grid md:grid-cols-3 md:gap-6 mt-10 ">
        <jet-section-title>
            <template #title>
                <slot name="title">幻灯片信息组 {{i+1}}</slot>
            </template>
            <template #description>
                <slot name="description">填写您的幻灯片内容。 <br>如果想增加数量请点击加号。</slot>
                <br>
                <el-button type="danger" v-show="i!=0" style="margin-top: 10px" @click="remove" size="mini"
                           icon="el-icon-delete"
                           circle></el-button>
            </template>
        </jet-section-title>
        <div class="mt-5 md:mt-0 md:col-span-2">
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-4 py-5 bg-white sm:p-6">
                    <div class="grid grid-cols-6 gap-6">

                        <RenderComponent v-model:content="mergeContent"/>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import JetSectionTitle from '@/Jetstream/SectionTitle'
import JetInput from '@/Jetstream/Input'
import JetLabel from '@/Jetstream/Label'
import RenderComponent from '@/Components/RenderComponent'

export default {
    name: "BannerForm",
    components: {
        JetSectionTitle,
        JetInput,
        JetLabel,
        RenderComponent
    },
    props: {
        banner: {
            type: Object,
            default: function () {
                return {}
            }
        },
        i: {
            type: Number,
            default: 0
        }
    },
    data() {
        return {
            //content: this.banner,
            component: this.$page.props.component,
        }
    },
    computed: {
        mergeContent() {
            const arr = []
            const that = this
            if (this.component.length > 0) {
                _.forEach(this.component, function (value, index) {//这里规定的就是第一个参数返回的是value值，第二个参数是下标index
                    const id = _.findIndex(that.banner, function (o) {
                        return o.column == value.column;
                    });
                    if (id != -1) {
                        arr.push(that.banner[id])
                    } else {
                        arr.push(value)
                    }
                });
                return arr
            }
        }
    },
    methods: {
        remove() {
            this.$emit('remove', this.i);
        }
    }
}
</script>
