<template>
    <div>

        <Head title="Settings" />
        <h1 class="mb-8 text-3xl font-bold">
            Settings
        </h1>
        <div class="max-w-3xl bg-white rounded shadow overflow-hidden">
            <div class="bg-white border-none w-full p-4 md:py-0 md:px-8 text-md md:text-md flex justify-end items-center">
                <button v-for="lang of langs" :key="`button-` + lang.code"
                    class="w-10 h-10 rounded mt-6 mr-1 text-white cursor-pointer hover:bg-indigo-300"
                    :class="(current_locale == lang.code) ? 'bg-red-600' : 'bg-indigo-600'" :value="lang.code"
                    @click="changeLang($event)">{{ lang.code }}</button>
            </div>
            <form @submit.prevent="submit">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model.trim="form.name" :error="form.errors.name" class-div="lg:w-1/2" label="Name" />
                    <text-input v-model.trim="form.phone" :error="form.errors.phone" class-div="lg:w-1/2" label="Phone" />
                    <text-input v-model.trim="form.phone_driver" :error="form.errors.phone_driver" class-div="lg:w-1/2"
                        label="Phone for Drivers" />
                    <text-input v-model.trim="form.email" :error="form.errors.email" class-div="lg:w-1/2" label="Email" />
                    <template v-for="lang of langs" :key="'name-' + lang.code">
                        <div v-show="lang.code == current_locale" class="w-full lg:w-1/2">
                            <text-input v-model.trim="form.address[lang.code]" :error="form.errors['address.' + lang.code]"
                                class-div="pr-0" :label="`Address (` + lang.code + `)`" />
                        </div>
                    </template>
                    <text-input v-model.trim="form.google_map_link" :error="form.errors.google_map_link"
                        class-div="lg:w-1/2" label="Google Map" />
                    <file-input-logo v-model.trim="form.logo" :error="form.errors.logo" class-div="lg:w-1/2" label="Logo" />
                    <file-input-video v-model.trim="form.video" :error="form.errors.video" class-div="lg:w-1/2"
                        label="Background video" />
                </div>
                <div class="flex items-center justify-end px-8 py-4 w-full bg-gray-100 border-t border-gray-200">
                    <loading-button :disabled="form.processing" :loading="form.processing" class="btn-green"
                        type="submit">Update</loading-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from "@/Shared/Layout.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";
import TextInput from "@/Shared/TextInput.vue";
import FileInputLogo from "@/Shared/FileInputLogo.vue";
import FileInputVideo from "@/Shared/FileInputVideo.vue";

import { Head, Link, useForm } from "@inertiajs/vue3";

export default {
    components: {
        LoadingButton,
        TextInput,
        FileInputLogo,
        FileInputVideo,
    },
    layout: Layout,
    remember: "form",
    props: {
        setting: Object,
    },
    data() {
        return {
            current_locale: this.$page.props.default_lang,
            langs: this.$page.props.langs,
            form: useForm({
                name: this.setting.name,
                logo: this.setting.logo ? this.setting.logo : this.$page.props.image.noImagePath,
                phone: this.setting.phone,
                phone_driver: this.setting.phone_driver,
                email: this.setting.email,
                address: this.setting.address,
                google_map_link: this.setting.google_map_link,
                video: this.setting.video,
            }),
        };
    },
    methods: {
        submit() {
            this.form.put(this.$route("setting.update", this.setting.id));
        },
        changeLang: function (e) {
            this.current_locale = e.target.value
        },
    },
};
</script>
