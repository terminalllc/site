<template>
    <div>

        <Head title="Calculation edit" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" :href="this.$route('calculations.index')">Calculations
            </Link>
            <span class="text-indigo-400 font-medium">/</span>Edit
        </h1>
        <div class="max-w-3xl bg-white rounded shadow overflow-hidden">
            <form @submit.prevent="submit">
                <div class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model.trim="form.name" :error="form.errors.name" class-div="lg:w-1/2" label="Name" />
                    <text-input v-model.trim="form.rate_14" :error="form.errors.rate_14" class-div="lg:w-1/2"
                        label="1-14 day" />
                    <text-input v-model.trim="form.rate_30" :error="form.errors.rate_30" class-div="lg:w-1/2"
                        label="15-30 day" />
                    <text-input v-model.trim="form.rate_60" :error="form.errors.rate_60" class-div="lg:w-1/2"
                        label="31-60 day" />
                    <text-input v-model.trim="form.rate_other" :error="form.errors.rate_other" class-div="lg:w-1/2"
                        label="Over 61 day" />
                    <text-input v-model.trim="form.rate_one_time" :error="form.errors.rate_one_time"
                        class-div="lg:w-1/2" label="One-time rate" />
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

export default {
    components: {
        LoadingButton,
        TextInput,
    },
    layout: Layout,
    props: {
        calculation: Object,
    },
    remember: "form",
    data() {
        return {
            form: useForm({
                name: this.calculation.name,
                rate_14: this.calculation.rate_14,
                rate_30: this.calculation.rate_30,
                rate_60: this.calculation.rate_60,
                rate_other: this.calculation.rate_other,
                rate_one_time: this.calculation.rate_one_time,
            }),
        };
    },
    methods: {
        submit() {
            this.form.put(this.$route("calculations.update", this.calculation.id));
        },
    },
};
</script>
