<template>
    <div>

        <Head title="Languages edit" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" :href="this.$route('languages.index')">Languages</Link>
            <span class="text-indigo-400 font-medium">/</span>Edit
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
                            <text-input v-model.trim="form.name[lang.code]" :error="form.errors['name.' + lang.code]"
                                class-div="pr-0" :label="`Name (` + lang.code + `)`" />
                        </div>
                    </template>
                    <text-input v-model.trim="form.code" :error="form.errors.code" class-div="lg:w-1/2" label="Code" />
                    <text-input v-model.trim="form.encoding" :error="form.errors.encoding" class-div="lg:w-1/2"
                        label="Encoding" />
                    <div class="items-center mb-6 pb-8 pr-6 w-1/2">
                        <label class="form-label">Default?: </label>
                        <input v-model="form.is_default" :true-value="1" :false-value="0" class="mr-2 pl-6 w-6 h-6"
                            type="checkbox" />
                    </div>
                    <div class="items-center mb-6 pb-8 pr-6 w-1/2">
                        <label class="form-label"> Status: </label>
                        <input v-model="form.status" :true-value="1" :false-value="0" class="mr-2 pl-6 w-6 h-6"
                            type="checkbox" />
                    </div>
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
    props: {
        language: Object,
    },
    data() {
        return {
            current_locale: this.$page.props.default_lang,
            langs: this.$page.props.langs,
            form: useForm({
                name: this.language.name,
                code: this.language.code,
                encoding: this.language.encoding,
                is_default: this.language.is_default,
                status: this.language.status,
            }),
        };
    },
    methods: {
        submit() {
            this.form.put(this.$route("languages.update", this.language.id));
        },
        changeLang: function (e) {
            this.current_locale = e.target.value
        },
    },
};
</script>
