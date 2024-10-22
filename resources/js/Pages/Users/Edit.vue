<template>
    <div>

        <Head title="User edit" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" :href="this.$route('users.index')">Users</Link>
            <span class="text-indigo-400 font-medium">/</span>Edit
        </h1>
        <div class="max-w-3xl bg-white rounded shadow overflow-hidden">
            <form @submit.prevent="submit">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model.trim="form.name" :error="form.errors.name" class-div="lg:w-1/2" label="Name" />
                    <text-input v-model.trim="form.email" :error="form.errors.email" class-div="lg:w-1/2"
                        label="Email" />
                    <select-input v-model="form.role" :error="form.errors.role" class-div="lg:w-1/2" label="Role">
                        <option v-for="item in roles" :key="item" :value="item">{{ item }}</option>
                    </select-input>
                    <text-input v-model.trim="form.password" :error="form.errors.password" class-div="lg:w-1/2"
                        type="password" autocomplete="new-password" label="Password" />
                    <select-input v-model="form.calculation_id" :error="form.errors.calculation_id" class-div="lg:w-1/2" label="Tariffs">
                        <option v-for="item in calculations" :key="item.id" :value="item.id">{{ item.name }}</option>
                    </select-input>
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
import SelectInput from "@/Shared/SelectInput.vue";

import { Head, Link, useForm } from "@inertiajs/vue3";

export default {
    components: {
        LoadingButton,
        TextInput,
        TextareaInput,
        SelectInput,
    },
    layout: Layout,
    remember: "form",
    props: {
        user: Object,
        calculations: Array,
    },
    data() {
        return {
            form: useForm({
                name: this.user.name,
                email: this.user.email,
                password: null,
                role: this.user.role,
                calculation_id: this.user.calculation_id
            }),
            roles: ['admin', 'partner'],
        };
    },
    methods: {
        submit() {
            this.form.put(this.$route("users.update", this.user.id));
        },
    },
};
</script>
