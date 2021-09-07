<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$system['title']}}</title>
    <link rel="stylesheet" href="/static/style/common.css">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <meta name="keywords" content="{{$system['keywords']}}" />
    <meta name="description" content="{{$system['description']}}" />
    <link href="https://cdn.bootcdn.net/ajax/libs/Swiper/6.8.0/swiper-bundle.css" rel="stylesheet">
    <link href="https://cdn.bootcdn.net/ajax/libs/Swiper/6.8.0/swiper-bundle.min.css" rel="stylesheet">

</head>
<body>
@include('templates.header')
@include('templates.banner')


    <div class="px-4 py-16 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8 lg:py-20">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-5">
        <div class="grid gap-6 md:grid-cols-2 md:col-span-2 lg:col-span-3">
            <div class="rounded lg:p-5 lg:transition lg:duration-300 lg:hover:bg-indigo-50">
                <div class="flex items-center mb-1">
                    <span
                        class="flex items-center justify-center w-4 h-4 mr-2 text-xs font-medium text-white rounded bg-deep-purple-accent-400">1</span>
                    <p class="text-lg font-semibold sm:text-base">Read the recipe</p>
                </div>
                <p class="text-sm text-gray-900">
                    Take a good look at the recipe. Don’t just skim it; read it through from start to finish. As you
                    read, visualize doing the steps which will help when you’re prepping.
                </p>
            </div>
            <div class="rounded lg:p-5 lg:transition lg:duration-300 lg:hover:bg-teal-50">
                <div class="flex items-center mb-1">
                    <span
                        class="flex items-center justify-center w-4 h-4 mr-2 text-xs font-medium text-teal-900 rounded bg-teal-accent-400">2</span>
                    <p class="text-lg font-semibold sm:text-base">Know the assumptions</p>
                </div>
                <p class="text-sm text-gray-900">
                    All recipes are written using certain conventions, which define the characteristics of common
                    ingredients. The rules vary from place to place.
                </p>
            </div>
            <div class="rounded lg:p-5 lg:transition lg:duration-300 lg:hover:bg-teal-50">
                <div class="flex items-center mb-1">
                    <span
                        class="flex items-center justify-center w-4 h-4 mr-2 text-xs font-medium text-white rounded md:text-teal-900 bg-deep-purple-accent-400 md:bg-teal-accent-400">3</span>
                    <p class="text-lg font-semibold sm:text-base">
                        Figure out the timing
                    </p>
                </div>
                <p class="text-sm text-gray-900">
                    Check the “prep time” and “total time” listed at the top to be sure you have enough time to complete
                    the recipe. Look for hints, such as the words “meanwhile” .
                </p>
            </div>
            <div class="rounded lg:p-5 lg:transition lg:duration-300 lg:hover:bg-indigo-50">
                <div class="flex items-center mb-1">
                    <span
                        class="flex items-center justify-center w-4 h-4 mr-2 text-xs font-medium text-teal-900 rounded md:text-white bg-teal-accent-400 md:bg-deep-purple-accent-400">4</span>
                    <p class="text-lg font-semibold sm:text-base">Plan ahead</p>
                </div>
                <p class="text-sm text-gray-900">
                    Missing a prep instruction can leave you scrambling in the middle of a recipe. Keep your eyes peeled
                    for time-consuming steps and be careful.
                </p>
            </div>
        </div>
        <div class="relative md:col-span-2 lg:col-span-2">
            <img
                class="inset-0 object-cover object-bottom w-full h-56 rounded shadow-lg lg:absolute lg:h-full"
                src="https://images.pexels.com/photos/3182759/pexels-photo-3182759.jpeg?auto=compress&amp;cs=tinysrgb&amp;dpr=2&amp;h=750&amp;w=1260"
                alt=""
            />
        </div>
    </div>
</div>

<section class="bg-gray-100 dark:bg-gray-900 lg:py-12 lg:flex lg:justify-center">
    <div class="bg-white dark:bg-gray-800 lg:mx-8 lg:flex lg:max-w-5xl lg:shadow-lg lg:rounded-lg">
        <div class="lg:w-1/2">
            <div class="h-64 bg-cover lg:rounded-lg lg:h-full"
                 style="background-image:url('/static/common/team.jpeg')"></div>
        </div>

        <div class="max-w-xl px-6 py-12 lg:max-w-5xl lg:w-1/2">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white md:text-3xl">Build Your New <span
                    class="text-indigo-600 dark:text-indigo-400">Idea</span></h2>
            <p class="mt-4 text-gray-600 dark:text-gray-400">Lorem, ipsum dolor sit amet consectetur adipisicing elit.
                Quidem modi reprehenderit vitae exercitationem aliquid dolores ullam temporibus enim expedita aperiam
                mollitia iure consectetur dicta tenetur, porro consequuntur saepe accusantium consequatur.</p>

            <div class="mt-8">
                <a href="#"
                   class="px-5 py-2 font-semibold text-gray-100 transition-colors duration-200 transform bg-gray-900 rounded-md hover:bg-gray-700">Start
                    Now</a>
            </div>
        </div>
    </div>
</section>
@include('templates.footer')

<script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/Swiper/6.8.0/swiper-bundle.js"></script>
<script src="https://cdn.bootcdn.net/ajax/libs/Swiper/6.8.0/swiper-bundle.min.js"></script>
<script src="@static/home/js/main.js"></script>
</body>
</html>
