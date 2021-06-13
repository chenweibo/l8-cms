<template>
  <div class="col-span-6 sm:col-span-4">
      <jet-label :for="content.column" :value="content.label+' ( '+ content.column+' )'"/>
    <div class="col-span-6 sm:col-span-4">
      <!-- Profile Photo File Input -->
      <input ref="photo" class="hidden"
             type="file"
             @change="updatePhotoPreview">
      <!-- Current Profile Photo -->
      <div v-show="! photoPreview" class="mt-2">
        <img class="rounded-full h-20 w-20 object-cover" src="/static/common/none.png">
      </div>

      <!-- New Profile Photo Preview -->
      <div v-show="photoPreview" class="mt-2">
                    <span
                        :style="'background-size: cover; background-repeat: no-repeat; background-position: center center; background-image: url(\'' + photoPreview + '\');'"
                        class="block rounded-full w-20 h-20">
                    </span>

      </div>

      <jet-secondary-button class="mt-2 mr-2" type="button" @click.prevent="selectNewPhoto">
        选择一张新照片
      </jet-secondary-button>

      <jet-secondary-button v-show="photoPreview" class=" mr-2 mt-2" type="button" @click.prevent="deletePhoto">
        删除照片
      </jet-secondary-button>
      <LabelInfo v-model:note="note" :id="content.id"/>
    </div>
  </div>
</template>
<script>
import JetLabel from '@/Jetstream/Label'

import JetSecondaryButton from '@/Jetstream/SecondaryButton'
import LabelInfo from '@/Components/LabelInfo'

export default {
  name: 'OneUpload',
  components: {
    JetSecondaryButton,
    LabelInfo,
    JetLabel
  },
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
    },
  },
  emits: ['update:content'],
  created() {
  },
  watch: {
    note: {
      handler(new_value, old_value) {
        this.content.note = new_value
      },
      deep: true
    },
      content: {
          handler(new_value, old_value) {
              this.photoPreview = this.content.value
          },
          deep: true
      }
  },
  computed: {},
  data() {
      //console.log(this.content)
    return {
      photoPreview: this.content.value,
      note: this.content.note
    };
  },
  methods: {
    selectNewPhoto() {
      this.$refs.photo.click();
    },
    deletePhoto() {
      this.photoPreview = null
      this.content.value = null
      this.$emit("update:content", this.content)
    },
    updatePhotoPreview() {
      let forms = new FormData()
      forms.append('file', this.$refs.photo.files[0])

      axios.post(route('files.upload'), forms).then(res => {
        this.photoPreview = '/static/' + res.data.path
        this.content.value = '/static/' + res.data.path
        this.$emit("update:content", this.content)
        //this.value = '/static/'+res.data.path
      })
    },
    clearPhotoFileInput() {
      if (this.$refs.photo?.value) {
        this.$refs.photo.value = null;

      }
    }
  }
}
</script>
<style scoped>
:deep(.el-upload) {
  text-align: left;
}
</style>
