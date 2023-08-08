<template>
  <div>
    <div id="dropdown" />
    <div class="md:flex md:flex-col">
      <div class="md:h-screen md:flex md:flex-col">
        <div class="md:flex md:flex-shrink-0">
          <div class="bg-indigo-900 md:flex-shrink-0 md:w-56 px-6 py-4 flex items-center justify-between md:justify-center">
            <Link class="mt-1 text-white uppercase" :href="this.$route('cars.index')">
              MAIN MENU
            </Link>
            <dropdown class="md:hidden" placement="bottom-end">
              <svg class="fill-white w-6 h-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z" /></svg>
              <!-- Mobile menu -->
                <template v-slot:dropdown>
                    <div class="mt-2 px-8 py-4 shadow-lg bg-indigo-800 rounded">
                        <div class="overflow-y-auto">
                            <div class="mb-4 cursor-pointer">
                                <div class="ml-4">
                                    <div class="mb-2">
                                    <!-- <Link class="flex items-center group py-2" href="/">
                                        <icon name="category" class="w-4 h-4 mr-2 fill-white" />
                                        <div class="text-green-600">Категории</div>
                                    </Link > -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </template>
            </dropdown>
          </div>
          <div class="bg-white border-b w-full p-4 md:py-0 md:px-12 text-sm md:text-md flex justify-between items-center">
            
            <dropdown class="mt-1" placement="bottom-end">
              <div class="flex items-center cursor-pointer select-none group">
                <div class="text-gray-700 group-hover:text-indigo-600 focus:text-indigo-600 mr-1 whitespace-nowrap">
                  <span>{{ $page.props.auth.user.name }}</span>
                </div>
                <icon name="chevron-down"/>
              </div>
                <template v-slot:dropdown>
                    <div class="mt-2 py-2 shadow-xl bg-white rounded text-sm">
                        <Link  class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" href="/">Profile</Link >
                        <Link  class="block px-6 py-2 hover:bg-indigo-500 hover:text-white" href="/">Users</Link >
                        <Link  class="block px-6 py-2 hover:bg-indigo-500 hover:text-white w-full text-left" :href="route('logout')" method="delete" as="button">Logout</Link >
                    </div>
                </template>
            </dropdown>
          </div>
        </div>
        <div class="md:flex md:flex-grow md:overflow-hidden">
          <main-menu class="hidden md:block bg-indigo-800 flex-shrink-0 w-56 p-6 overflow-y-auto" />
          <div class="md:flex-1 px-4 py-8 md:p-12 md:overflow-y-auto" scroll-region>
            <flash-messages />
            <slot />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Icon from '@/Shared/Icon.vue'
import Dropdown from '@/Shared/Dropdown.vue'
import FlashMessages from '@/Shared/FlashMessages.vue'
import MainMenu from '@/Shared/MainMenu.vue'

export default {
  components: {
    Icon,
    Dropdown,
    FlashMessages,
    MainMenu
  },
}
</script>
<style>
.swal2-title {
  font-size: 1.1em;
}
.swal2-popup {
    width: 24em;
}
</style>
