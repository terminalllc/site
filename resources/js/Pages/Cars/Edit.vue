<template>
    <div>

        <Head title="Cars edit" />
        <h1 class="mb-8 text-3xl font-bold">
            <Link class="text-indigo-400 hover:text-indigo-600" :href="this.$route('cars.index')">Cars</Link>
            <span class="text-indigo-400 font-medium">/</span>Edit
        </h1>
        <div class="max-w-3xl bg-white rounded shadow overflow-hidden">
            <div>
                <ul class="flex justify-start items-center m-4 flex-wrap">
                    <template v-for="(tab, index) in tabs" :key="index">
                        <li class="cursor-pointer py-2 px-4 text-gray-600 border-b-8"
                            :class="activeTab === index ? 'border-red-500' : ''" @click="activeTab = index">
                            {{ tab }}
                        </li>
                    </template>
                </ul>
            </div>
            <form @submit.prevent="submit">
                <div v-show="activeTab === 0" class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <text-input v-model.trim="form.name" :error="form.errors.name" class-div="lg:w-1/2" label="Name" />
                    <text-input v-model.trim="form.vin" :error="form.errors.vin" class-div="lg:w-1/2" label="VIN" />
                    <text-input v-model.trim="form.on_terminal_at" type="date" :error="form.errors.on_terminal_at"
                        class-div="lg:w-1/2" label="Date of arrival at the terminal" />
                    <text-input v-model.trim="form.out_terminal_at" type="date" :error="form.errors.out_terminal_at"
                        class-div="lg:w-1/2" label="Date of departure from the terminal" />
                    <div class="items-center mb-6 pb-8 pr-6 w-1/2">
                        <label class="form-label"> Status: </label>
                        <input v-model="form.status" :true-value="1" :false-value="0" class="mr-2 pl-6 w-6 h-6"
                            type="checkbox" />
                    </div>
                </div>
                <div v-show="activeTab === 1" class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <file-input-zip v-model.trim="zipContainerImages" class-div="lg:w-1/2" label="ZIP Images" />
                    <div class="flex pb-8 w-full pr-6 font-medium">
                        <button class="w-10 bg-green-600 h-10 rounded cursor-pointer text-white" title="Add a new image"
                            @click.prevent="form.containerImages.push(this.$page.props.image.noImagePath)">
                            <svg class="fill-current text-white w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M11 9V5H9v4H5v2h4v4h2v-4h4V9h-4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20z" />
                            </svg>
                        </button>
                    </div>
                    <template v-for="(image, index) of form.containerImages" :key="index">
                        <div class="flex pb-8 w-full pr-6">
                            <file-input-image v-model.trim="form.containerImages[index]"
                                :error="form.errors[`containerImages.` + index]" class-div="lg:w-1/2"
                                :label="`Images in container (` + (index + 1) + `)`" />

                            <button
                                class="bg-red-600 w-6 h-6 rounded ml-6 cursor-pointer flex justify-center items-center self-center"
                                title="Remove" @click.prevent="form.containerImages.splice(index, 1);">
                                <svg class="fill-current text-white w-3 h-3" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
                <div v-show="activeTab === 2" class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <file-input-zip v-model.trim="zipTerminalImages" class-div="lg:w-1/2" label="ZIP Images" />
                    <div class="flex pb-8 w-full pr-6 font-medium">
                        <button class="w-10 bg-green-600 h-10 rounded cursor-pointer text-white" title="Add a new image"
                            @click.prevent="form.terminalImages.push(this.$page.props.image.noImagePath)">
                            <svg class="fill-current text-white w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M11 9V5H9v4H5v2h4v4h2v-4h4V9h-4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20z" />
                            </svg>
                        </button>
                    </div>
                    <template v-for="(image, index) of form.terminalImages" :key="index">
                        <div class="flex pb-8 w-full pr-6">
                            <file-input-image v-model.trim="form.terminalImages[index]"
                                :error="form.errors[`terminalImages.` + index]" class-div="lg:w-1/2"
                                :label="`Images in container (` + (index + 1) + `)`" />

                            <button
                                class="bg-red-600 w-6 h-6 rounded ml-6 cursor-pointer flex justify-center items-center self-center"
                                title="Remove" @click.prevent="form.terminalImages.splice(index, 1);">
                                <svg class="fill-current text-white w-3 h-3" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z" />
                                </svg>
                            </button>
                        </div>
                    </template>
                </div>
                <div v-show="activeTab === 3" class="flex flex-wrap -mb-8 -mr-6 p-8">
                    <file-input-zip v-model.trim="zipOutImages" class-div="lg:w-1/2" label="ZIP Images" />
                    <div class="flex pb-8 w-full pr-6 font-medium">
                        <button class="w-10 bg-green-600 h-10 rounded cursor-pointer text-white" title="Add a new image"
                            @click.prevent="form.outImages.push(this.$page.props.image.noImagePath)">
                            <svg class="fill-current text-white w-6 h-6 inline" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <path d="M11 9V5H9v4H5v2h4v4h2v-4h4V9h-4zm-1 11a10 10 0 1 1 0-20 10 10 0 0 1 0 20z" />
                            </svg>
                        </button>
                    </div>
                    <template v-for="(image, index) of form.outImages" :key="index">
                        <div class="flex pb-8 w-full pr-6">
                            <file-input-image v-model.trim="form.outImages[index]"
                                :error="form.errors[`outImages.` + index]" class-div="lg:w-1/2"
                                :label="`Images in container (` + (index + 1) + `)`" />

                            <button
                                class="bg-red-600 w-6 h-6 rounded ml-6 cursor-pointer flex justify-center items-center self-center"
                                title="Remove" @click.prevent="form.outImages.splice(index, 1);">
                                <svg class="fill-current text-white w-3 h-3" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                    <path d="M6 2l2-2h4l2 2h4v2H2V2h4zM3 6h14l-1 14H4L3 6zm5 2v10h1V8H8zm3 0v10h1V8h-1z" />
                                </svg>
                            </button>
                        </div>
                    </template>
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
import FileInputImage from "@/Shared/FileInputImage.vue";
import FileInputZip from "@/Shared/FileInputZip.vue";
import { Head, Link, useForm } from "@inertiajs/vue3";

export default {
    components: {
        LoadingButton,
        TextInput,
        TextareaInput,
        FileInputImage,
        FileInputZip,
    },
    layout: Layout,
    remember: "form",
    props: {
        car: Object,
    },
    data() {
        return {
            form: useForm({
                name: this.car.name,
                vin: this.car.vin,
                containerImages: this.car.containerImages,
                terminalImages: this.car.terminalImages,
                outImages: this.car.outImages,
                on_terminal_at: this.car.on_terminal_at,
                out_terminal_at: this.car.out_terminal_at,
                status: this.car.status,
            }),
            noImage: this.$page.props.image.noImagePath,
            zipContainerImages: [],
            zipTerminalImages: [],
            zipOutImages: [],
            activeTab: 0,
            tabs: ['General', 'In container', 'In Terminal', 'After the terminal'],
        };
    },
    watch: {
        zipContainerImages: {
            handler(val, oldVal) {
                this.form.containerImages = this.form.containerImages.concat(val)
            },
            deep: true
        },
        zipTerminalImages: {
            handler(val, oldVal) {
                this.form.terminalImages = this.form.terminalImages.concat(val)
            },
            deep: true
        },
        zipOutImages: {
            handler(val, oldVal) {
                this.form.outImages = this.form.outImages.concat(val)
            },
            deep: true
        },
    },
    methods: {
        submit() {
            this.form.put(this.$route("cars.update", this.car.id));
        },
    },
};
</script>
