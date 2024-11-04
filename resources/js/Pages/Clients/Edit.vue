<template>
    <div>

        <Head title="Clients edit" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" :href="this.$route('clients.index')">Clients</Link>
            <span class="text-indigo-400 font-medium">/</span>Edit
        </h1>
        <div class="max-w-3xl bg-white rounded shadow overflow-hidden">
            <form @submit.prevent="submit">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model.trim="form.name" :error="form.errors.name" class-div="lg:w-1/2" label="Name" />
                    <text-input v-model.trim="form.phone" :error="form.errors.phone" class-div="lg:w-1/2"
                        label="Phone" />
                    <text-input v-model.trim="form.email" :error="form.errors.email" class-div="lg:w-1/2"
                        label="Email" />
                    <select-input v-model="form.calculation_id" :error="form.errors.calculation_id" class-div="lg:w-1/2"
                        label="Tariffs">
                        <option v-for="item in calculations" :key="item.id" :value="item.id">
                            {{ item.name }}
                        </option>
                    </select-input>
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
import { Head, Link, useForm } from "@inertiajs/vue3";
import SelectInput from "@/Shared/SelectInput.vue";

export default {
    components: {
        LoadingButton,
        TextInput,
        SelectInput,
    },
    layout: Layout,
    props: {
        client: Object,
        calculations: Array,
    },
    remember: "form",
    data() {
        return {
            form: useForm({
                name: this.client.name,
                phone: this.client.phone,
                email: this.client.email,
                status: this.client.status,
                calculation_id: this.client.calculation_id
            }),
        };
    },
    methods: {
        submit() {
            this.form.put(this.$route("clients.update", this.client.id));
        },
    },
};
</script>
