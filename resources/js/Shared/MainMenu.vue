<template>
    <div>
        <div class="mb-2">
            <Link class="group flex items-center justify-start py-2 text-center" :href="this.$route('clients.index')">
            <div :class="isUrl('admin/clients') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">
                Clients
            </div>
            </Link>
            <Link class="group flex items-center justify-start py-2 text-center" :href="this.$route('cars.index')">
            <div :class="isUrl('admin/cars') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">
                Cars
            </div>
            </Link>
            <Link class="group flex items-center justify-start py-2 text-center" :href="this.$route('setting.edit', 1)">
            <div :class="isUrl('admin/settings') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">
                Settings
            </div>
            </Link>
            <Link class="group flex items-center justify-start py-2 text-center" :href="this.$route('languages.index')">
            <div :class="isUrl('admin/languages') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">
                Languages
            </div>
            </Link>
            <Link class="group flex items-center justify-start py-2 text-center" :href="this.$route('translations.index')">
            <div :class="isUrl('admin/translations') ? 'text-white' : 'text-indigo-300 group-hover:text-white'">
                Translations
            </div>
            </Link>
        </div>
    </div>
</template>

<script>
export default {
    methods: {
        isUrl(...urls) {
            let currentUrl = this.$page.url.substr(1)

            if (urls[0] === '') {
                return currentUrl === ''
            }

            return urls.filter(url => currentUrl.startsWith(url)).length
        },
    },
};
</script>
