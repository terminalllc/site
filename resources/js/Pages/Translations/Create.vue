<template>
    <div>
        <Head title="Translations create" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" :href="this.$route('translations.index')">Translations</Link>
            <span class="text-indigo-400 font-medium">/</span>Create
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
                    <template v-for="lang of langs" :key="'name-' + lang.code">
                        <div v-show="lang.code == current_locale" class="w-full lg:w-1/2">
                            <text-input v-model.trim="form.text[lang.code]" :error="form.errors['text.' + lang.code]"
                                class-div="pr-0" :label="`Text (` + lang.code + `)`" />
                        </div>
                    </template>
                    <text-input v-model.trim="form.group" :error="form.errors.group" class-div="lg:w-1/2" label="Group" />
                    <text-input v-model.trim="form.key" :error="form.errors.key"
                        class-div="lg:w-1/2" label="Key" />
                </div>
                <div class="flex items-center justify-end px-8 py-4 w-full bg-gray-100 border-t border-gray-200">
                    <loading-button :disabled="form.processing" :loading="form.processing" class="btn-green"
                        type="submit">Create</loading-button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from "@/Shared/Layout.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";
import TextInput from "@/Shared/TextInput.vue";
import TextareaInput from "@/Shared/TextareaInput.vue";

import { Head, Link, useForm } from "@inertiajs/vue3";

export default {
    components: {
        LoadingButton,
        TextInput,
        TextareaInput,
    },
    layout: Layout,
    remember: "form",
    data() {
        return {
            current_locale: this.$page.props.default_lang,
            langs: this.$page.props.langs,
            form: useForm({
                text: {},
                group: null,
                key: null,
            }),
        };
    },
    methods: {
        submit() {
            this.form.post(this.$route("translations.store"));
        },
        changeLang: function (e) {
            this.current_locale = e.target.value
        },
    },
};
</script>
