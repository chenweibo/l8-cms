<template>
    <div>
        <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:hidden">
                <inertia-link :href="hasPrev?generateLink(current_page-1):'#'"
                              as="a"
                              class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    上一页
                </inertia-link>
                <inertia-link :href="hasNext?generateLink(current_page+1):'#'"
                              as="a"
                              class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    下一页
                </inertia-link>
            </div>
            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                <div>
                    <p class="text-sm text-gray-700">
                        共 {{ total }} 条内容
                    </p>
                </div>
                <div>
                    <nav aria-label="Pagination" class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                        <inertia-link :href="hasPrev?generateLink(current_page-1):'#'"
                                      as="a"
                                      class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">上一页</span>
                            <!-- Heroicon name: solid/chevron-left -->
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor"
                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </inertia-link>
                        <!-- Current: "z-10 bg-indigo-50 border-indigo-500 text-indigo-600", Default: "bg-white border-gray-300 text-gray-500 hover:bg-gray-50" -->
                        <!--                 no cur       bg-white border-gray-300  text-gray-500 hover:bg-gray-50-->
                        <!--                  cur      z-10 bg-indigo-50 border-indigo-500 text-indigo-600-->
                        <inertia-link v-for="(v,key) in last_page" :key="key"
                                      :class="{'z-10 bg-indigo-50 border-indigo-500 text-indigo-600':key+1===current_page}"
                                      :href="generateLink(key + 1)"
                                      as="a"
                                      class="bg-white border-gray-300  text-gray-500 hover:bg-gray-50 relative inline-flex items-center px-4 py-2 border text-sm font-medium"
                        >
                            {{ key + 1 }}
                        </inertia-link>

                        <inertia-link :href="hasNext?generateLink(current_page+1):'#'"
                                      as="a"
                                      class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                            <span class="sr-only">下一页</span>
                            <!-- Heroicon name: solid/chevron-right -->
                            <svg aria-hidden="true" class="h-5 w-5" fill="currentColor"
                                 viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path clip-rule="evenodd"
                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                      fill-rule="evenodd"/>
                            </svg>
                        </inertia-link>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "usually",
    props: {
        "current_page": {
            type: Number,
            default: 1
        },
        link: {
            type: Array,
            default: () => {
                return []
            }
        },
        total: {
            type: Number,
            default: 0
        },
        url: {
            type: String,
            default: ''
        },
        "last_page": {
            type: Number,
            default: 0
        },
    },
    computed: {
        hasNext() {
            return this.current_page < this.last_page;
        },
        hasPrev() {
            return this.current_page - 1 >= 1
        }
    },
    methods: {
        generateLink(page) {
            return route(this.url, {page: page})
        }
    }

}
</script>

<style scoped>

</style>
