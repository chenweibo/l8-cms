<template>
   <div>
    <h2 class="font-semibold text-xl text-gray-800 mb-3 leading-tight">
        {{ $page.props.title }}
    </h2>
    <inertia-link :href="route('categories.create')">
        <button class=" group flex items-center  py-1.5 px-4 bg-gray-700 text-white font-semibold rounded-lg shadow-md hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-75">
            <svg class="group-hover:text-light-blue-600 text-light-blue-500 mr-2" width="12" height="20" fill="currentColor">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M6 5a1 1 0 011 1v3h3a1 1 0 110 2H7v3a1 1 0 11-2 0v-3H2a1 1 0 110-2h3V6a1 1 0 011-1z"/>
            </svg>
            新增内容
        </button>
    </inertia-link>



    <div class="bg-white shadow-md rounded my-6 tab-h">
        <table class=" w-full table-auto ">
            <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">id</th>
                <th class="py-3 px-6 text-left">名称</th>
                <th class="py-3 px-6 text-left">重定向</th>
                <th class="py-3 px-6 text-center">排序</th>
                <th class="py-3 px-6 text-center">缩略图</th>
                <th class="py-3 px-6 text-center">显示</th>
                <th class="py-3 px-6 text-center">操作</th>
            </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">

            </tbody>
        </table>
    </div>

   </div>
</template>

<script>
export default {
    name: "ListFrame"
}
</script>

<style scoped>

</style>
