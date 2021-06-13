<template>
    <div class="box">
        <el-tag
            v-for="tag in dynamicTags"
            :key="tag"
            :disable-transitions="false"
            closable
            @close="handleClose(tag)">
            {{ tag }}
        </el-tag>
        <el-input
            v-if="inputVisible"
            ref="saveTagInput"
            v-model="inputValue"
            class="input-new-tag"
            size="small"
            @blur="handleInputConfirm"
            @keyup.enter.native="handleInputConfirm"
        >
        </el-input>
        <el-button v-else class="button-new-tag" size="small" @click="showInput">+ 标签</el-button>

    </div>
</template>
<style>
.el-tag + .el-tag {
    margin-left: 10px;
}

.button-new-tag {
    margin-left: 10px;
    height: 32px;
    line-height: 30px;
    padding-top: 0;
    padding-bottom: 0;
}

.input-new-tag {
    width: 90px;
    margin-left: 10px;
    vertical-align: bottom;
}

.box {
    display: inline-block;
}

</style>

<script>
export default {
    data() {
        return {
            dynamicTags: this.note,
            inputVisible: false,
            inputValue: ''
        };
    },
    emits: ['update:note'],
    props: {
        note: {
            type: Array,
            default: () => {
                return []
            }
        },
        id:Number,

    },
    methods: {
        handleClose(tag) {
            this.dynamicTags.splice(this.dynamicTags.indexOf(tag), 1);
            axios.put(route('components.updateNote',this.id),{note:this.dynamicTags})
        },

        showInput() {
            this.inputVisible = true;
            this.$nextTick(_ => {
                this.$refs.saveTagInput.$refs.input.focus();
            });
        },
        updateNote(val){
            axios.put(route('components.updateNote',this.id),{note:val})
        },
        handleInputConfirm() {
            let inputValue = this.inputValue;
            if (inputValue) {
                if (this.dynamicTags instanceof Array) {
                    this.dynamicTags.push(inputValue);
                    this.$emit('update:note', this.dynamicTags)
                    this.updateNote(this.dynamicTags)
                } else {
                    this.dynamicTags = []
                    this.dynamicTags.push(inputValue);
                    this.$emit('update:note', this.dynamicTags)
                    this.updateNote(this.dynamicTags)
                }

            }
            this.inputVisible = false;
            this.inputValue = '';
        }
    }
}
</script>
