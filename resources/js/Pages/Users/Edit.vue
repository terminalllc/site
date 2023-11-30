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
                    <select-input v-model="form.role" :error="form.errors.role" class-div="lg:w-1/2"
                        label="Role">
                        <option v-for="item in roles" :key="item" :value="item">{{ item }}</option>
                    </select-input>
                    <text-input v-model.trim="form.password" :error="form.errors.password" class-div="lg:w-1/2" type="password"
                        autocomplete="new-password" label="Password" />
                    <div class="items-center mb-6 pb-8 pr-6 w-1/2">
                        <label class="form-label"> Calculation of the amount for parking according to the general tariff? </label>
                        <input v-model="form.is_calculation_amount_at_general_rate" class="mr-2 pl-6 w-6 h-6"
                            type="checkbox" />
                    </div>
                    <text-input v-model.number="form.amount_for_parking_first_seven_days" :is-disabled="form.is_calculation_amount_at_general_rate" type="number" :error="form.errors.amount_for_parking_first_seven_days" class-div="lg:w-1/2" label="Amount for parking first seven days" />
                    <text-input v-model.number="form.amount_for_parking_general" type="number" :error="form.errors.amount_for_parking_general" class-div="lg:w-1/2" label="Amount for parking general" />
                    <text-input v-model.number="form.amount_for_issuing_car" :is-disabled="!form.is_calculation_amount_at_general_rate" type="number" :error="form.errors.amount_for_issuing_car" class-div="lg:w-1/2" label="Amount for issuing" />
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
    },
    data() {
        return {
            form: useForm({
                name: this.user.name,
                email: this.user.email,
                password: null,
                role: this.user.role,
                is_calculation_amount_at_general_rate: this.user.is_calculation_amount_at_general_rate,
                amount_for_parking_first_seven_days: this.user.amount_for_parking_first_seven_days,
                amount_for_parking_general: this.user.amount_for_parking_general,
                amount_for_issuing_car: this.user.amount_for_issuing_car,
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
