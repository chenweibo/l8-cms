<template>
   <div>
    <h2 class="font-semibold text-xl text-gray-800 mb-3 leading-tight">
        {{ $page.props.title }}
    </h2>
    <inertia-link :href="route('categories.create')">
        <button
            class="focus:outline-none text-white text-sm py-1.5 px-2.5 bg-gray-700 hover:bg-gray-900 hover:shadow-lg">
            添加
        </button>
    </inertia-link>


    <div class="bg-white shadow-md rounded my-6 tab-h">
        <table class=" w-full table-auto ">
            <thead>
            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                <th class="py-3 px-6 text-left">id</th>
                <th class="py-3 px-6 text-left">名称</th>
                <th class="py-3 px-6 text-left">重定向</th>
                <th class="py-3 px-6 text-left">链接</th>
                <th class="py-3 px-6 text-center">排序</th>

                <th class="py-3 px-6 text-center">栏目图</th>
                <th class="py-3 px-6 text-center">显示</th>
                <th class="py-3 px-6 text-left">类型</th>
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
