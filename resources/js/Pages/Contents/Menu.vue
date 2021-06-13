<template>
    <div>
        <a :class="{'hover:bg-gray-200 dark:hover:bg-gray-700 dark:hover:text-gray-200 hover:text-gray-700':!isHas}"
           class="flex items-center px-4 py-2 mt-5 text-gray-600 transition-colors duration-200 transform rounded-md dark:text-gray-400 "
           href="#">
            <span v-html="spacing"></span>
            <svg v-if="isHas" class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path clip-rule="evenodd"
                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                      fill-rule="evenodd"/>
            </svg>
            <svg v-else class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>

            <span class="mx-2 font-medium">{{ model.name }}</span>
        </a>
        <template v-if="model.children && model.children.length">
            <Menu
                v-for="model in model.children"
                :level='level + 1'
                :model="model"
                class="item">
            </Menu>
        </template>
    </div>

</template>

<script>
export default {
    name: "Menu",
    props: {
        model: {
            type: Object,
            required: true
        },
        level: {
            type: Number,
            default: 0
        }
    },
    computed: {
        isHas: function () {
            return this.model.children && this.model.children.length
        },
        spacing: function () {
            let str = ''
            for (var i = 0; i < this.level; i++) {
                str = str + "&nbsp;&nbsp;&nbsp;";
            }
            return str
        },
    },
}
</script>

<style scoped>

</style>
