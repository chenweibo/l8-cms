<template>
    <div>
        <jet-banner/>

        <div class="min-h-screen bg-gray-100">

            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-16">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex-shrink-0 flex items-center">
                                <inertia-link :href="route('dashboard')">
                                    <jet-application-mark class="block h-9 w-auto"/>
                                </inertia-link>
                            </div>

                            <!-- Navigation Links -->

                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <jet-nav-link :active="route().current('dashboard')" :href="route('dashboard')">
                                    仪表盘
                                </jet-nav-link>
                                <jet-nav-link :active="route().current('basic.show')" :href="route('basic.show')">
                                    基本设置
                                </jet-nav-link>
                                <jet-nav-link :active="route().current('banners.*')" :href="route('banners.index')">
                                    幻灯片设置
                                </jet-nav-link>
                                <jet-nav-link :active="route().current('categories.*')"
                                              :href="route('categories.index')">
                                    栏目设置
                                </jet-nav-link>
                                <jet-nav-link :active="route().current('contents.*')" :href="route('contents.index')">
                                    内容设置
                                </jet-nav-link>
                                <jet-nav-link :active="route().current('messages.*')" :href="route('messages.index')">
                                    留言管理
                                </jet-nav-link>
                                <jet-nav-link v-if="$page.props.user.isAdmin ==1"
                                              :active="route().current('components.*')"
                                              :href="route('components.index')">
                                    组件设置
                                </jet-nav-link>
                                <jet-nav-link v-if="$page.props.user.isAdmin ==1"
                                              :active="route().current('accounts.*')"
                                              :href="route('accounts.index')">
                                    账户管理
                                </jet-nav-link>
                                <jet-nav-link :href="route('files.index')" :active="route().current('files.*')">
                                    文件管理
                                </jet-nav-link>

                                <jet-nav-link v-if="$page.props.user.isAdmin ==1" :active="route().current('doc.*')"
                                              :href="route('doc.index')">
                                    调用文档
                                </jet-nav-link>
                                <a href="/" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition"  target="_blank">
                                    <svg  class="h-5 w-5 mr-1" fill="#FBBF24" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                    </svg>
                                    前往首页</a>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <div class="ml-3 relative">
                                <!-- Teams Dropdown -->
                                <jet-dropdown v-if="$page.props.jetstream.hasTeamFeatures" align="right" width="60">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:bg-gray-50 hover:text-gray-700 focus:outline-none focus:bg-gray-50 active:bg-gray-50 transition"
                                                type="button">
                                                {{ $page.props.user.current_team.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path clip-rule="evenodd"
                                                          d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                                          fill-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <div class="w-60">
                                            <!-- Team Management -->
                                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    管理团队
                                                </div>

                                                <!-- Team Settings -->
                                                <jet-dropdown-link
                                                    :href="route('teams.show', $page.props.user.current_team)">
                                                    团队设定
                                                </jet-dropdown-link>

                                                <jet-dropdown-link v-if="$page.props.jetstream.canCreateTeams"
                                                                   :href="route('teams.create')">
                                                    建立新团队
                                                </jet-dropdown-link>

                                                <div class="border-t border-gray-100"></div>

                                                <!-- Team Switcher -->
                                                <div class="block px-4 py-2 text-xs text-gray-400">
                                                    切换团队
                                                </div>

                                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                                    <form @submit.prevent="switchToTeam(team)">
                                                        <jet-dropdown-link as="button">
                                                            <div class="flex items-center">
                                                                <svg v-if="team.id == $page.props.user.current_team_id"
                                                                     class="mr-2 h-5 w-5 text-green-400" fill="none"
                                                                     stroke="currentColor" stroke-linecap="round"
                                                                     stroke-linejoin="round" stroke-width="2"
                                                                     viewBox="0 0 24 24">
                                                                    <path
                                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                                </svg>
                                                                <div>{{ team.name }}</div>
                                                            </div>
                                                        </jet-dropdown-link>
                                                    </form>
                                                </template>
                                            </template>
                                        </div>
                                    </template>
                                </jet-dropdown>
                            </div>

                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <jet-dropdown align="right" width="48">
                                    <template #trigger>
                                        <button v-if="$page.props.jetstream.managesProfilePhotos"
                                                class="flex text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                            <img :alt="$page.props.user.name"
                                                 :src="$page.props.user.profile_photo_url"
                                                 class="h-8 w-8 rounded-full object-cover"/>
                                        </button>

                                        <span v-else class="inline-flex rounded-md">
                                            <button
                                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition"
                                                type="button">
                                                {{ $page.props.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" fill="currentColor"
                                                     viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                    <path clip-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          fill-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <!-- Account Management -->
                                        <div class="block px-4 py-2 text-xs text-gray-400">
                                            管理帐户
                                        </div>

                                        <jet-dropdown-link :href="route('profile.show')">
                                            用户资料
                                        </jet-dropdown-link>

                                        <jet-dropdown-link v-if="$page.props.jetstream.hasApiFeatures"
                                                           :href="route('api-tokens.index')">
                                            API令牌
                                        </jet-dropdown-link>

                                        <div class="border-t border-gray-100"></div>

                                        <!-- Authentication -->
                                        <form @submit.prevent="logout">
                                            <jet-dropdown-link as="button">
                                                登出
                                            </jet-dropdown-link>
                                        </form>
                                    </template>
                                </jet-dropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button
                                class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition"
                                @click="showingNavigationDropdown = ! showingNavigationDropdown">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"/>
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        d="M6 18L18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
                     class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <jet-responsive-nav-link :active="route().current('dashboard')" :href="route('dashboard')">
                            仪表盘
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :active="route().current('basic.show')" :href="route('basic.show')">
                            基本设置
                        </jet-responsive-nav-link>
                        <jet-responsive-nav-link :active="route().current('components.*')"
                                                 :href="route('components.index')">
                            组件设置
                        </jet-responsive-nav-link>
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="flex items-center px-4">
                            <div v-if="$page.props.jetstream.managesProfilePhotos" class="flex-shrink-0 mr-3">
                                <img :alt="$page.props.user.name"
                                     :src="$page.props.user.profile_photo_url"
                                     class="h-10 w-10 rounded-full object-cover"/>
                            </div>

                            <div>
                                <div class="font-medium text-base text-gray-800">{{ $page.props.user.name }}</div>
                                <div class="font-medium text-sm text-gray-500">{{ $page.props.user.email }}</div>
                            </div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <jet-responsive-nav-link :active="route().current('profile.show')"
                                                     :href="route('profile.show')">
                                轮廓
                            </jet-responsive-nav-link>

                            <jet-responsive-nav-link v-if="$page.props.jetstream.hasApiFeatures"
                                                     :active="route().current('api-tokens.index')"
                                                     :href="route('api-tokens.index')">
                                API 令牌
                            </jet-responsive-nav-link>

                            <!-- Authentication -->
                            <form method="POST" @submit.prevent="logout">
                                <jet-responsive-nav-link as="button">
                                    登出
                                </jet-responsive-nav-link>
                            </form>

                            <!-- Team Management -->
                            <template v-if="$page.props.jetstream.hasTeamFeatures">
                                <div class="border-t border-gray-200"></div>

                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    管理团队
                                </div>

                                <!-- Team Settings -->
                                <jet-responsive-nav-link :active="route().current('teams.show')"
                                                         :href="route('teams.show', $page.props.user.current_team)">
                                    团队设置
                                </jet-responsive-nav-link>

                                <jet-responsive-nav-link :active="route().current('teams.create')"
                                                         :href="route('teams.create')">
                                    创建新团队
                                </jet-responsive-nav-link>

                                <div class="border-t border-gray-200"></div>

                                <!-- Team Switcher -->
                                <div class="block px-4 py-2 text-xs text-gray-400">
                                    换队
                                </div>

                                <template v-for="team in $page.props.user.all_teams" :key="team.id">
                                    <form @submit.prevent="switchToTeam(team)">
                                        <jet-responsive-nav-link as="button">
                                            <div class="flex items-center">
                                                <svg v-if="team.id == $page.props.user.current_team_id"
                                                     class="mr-2 h-5 w-5 text-green-400" fill="none"
                                                     stroke="currentColor" stroke-linecap="round"
                                                     stroke-linejoin="round"
                                                     stroke-width="2" viewBox="0 0 24 24">
                                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div>{{ team.name }}</div>
                                            </div>
                                        </jet-responsive-nav-link>
                                    </form>
                                </template>
                            </template>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Heading -->
            <header v-if="$slots.header" class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    <slot name="header"></slot>
                </div>
            </header>

            <!-- Page Content -->
            <main>
                <slot></slot>
            </main>
        </div>
    </div>
</template>

<script>
import JetApplicationMark from '@/Jetstream/ApplicationMark'
import JetBanner from '@/Jetstream/Banner'
import JetDropdown from '@/Jetstream/Dropdown'
import JetDropdownLink from '@/Jetstream/DropdownLink'
import JetNavLink from '@/Jetstream/NavLink'
import JetResponsiveNavLink from '@/Jetstream/ResponsiveNavLink'

export default {
    components: {
        JetApplicationMark,
        JetBanner,
        JetDropdown,
        JetDropdownLink,
        JetNavLink,
        JetResponsiveNavLink,
    },

    data() {
        return {
            showingNavigationDropdown: false,
        }
    },

    methods: {
        switchToTeam(team) {
            this.$inertia.put(route('current-team.update'), {
                'team_id': team.id
            }, {
                preserveState: false
            })
        },

        logout() {

            this.$inertia.post(route('logout.admin'));
        },
    }
}
</script>
