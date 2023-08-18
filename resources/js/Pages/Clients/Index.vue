<template>
    <div>

        <Head title="Clients" />
        <h1 class="mb-8 text-3xl font-bold">Clients</h1>
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="flex w-full bg-white rounded shadow">
                    <input v-model="form.search" class="relative px-6 py-3 w-full rounded focus:shadow-outline"
                        autocomplete="off" type="text" name="search" placeholder="Search..."
                        @input="$emit('input', $event.target.value)" />
                </div>
                <icon v-if="form.search?.length > 0" name="x-mark" class="text-red-600 ml-3" @click="reset" />
            </div>
            <Link class="btn-green text-white" :href="this.$route('clients.create')">
            <span>Create</span>
            </Link>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="whitespace-no-wrap w-full">
                <tr class="text-left font-bold bg-gray-400">
                    <th class="px-4">#</th>
                    <th class="px-4">Name</th>
                    <th class="px-4">Phone</th>
                    <th class="px-4">Email</th>
                    <th class="px-4">Status</th>
                    <th class="pb-12 px-4" />
                </tr>
                <tr v-for="(client, index) in clients.data" :key="client.id"
                    class="hover:bg-gray-100 focus-within:bg-gray-100" :class="client.presentImages ? `bg-green-200` : ``">
                    <td class="px-4 py-3 w-2 border-t">
                        {{ index + 1 }}
                    </td>
                    <td class="px-4 border-t">
                        {{ client.name }}
                    </td>
                    <td class="px-4 border-t">
                        {{ client.phone }}
                    </td>
                    <td class="px-4 border-t">
                        {{ client.email }}
                    </td>
                    <td class="px-4 border-t">
                        {{ client.status }}
                    </td>
                    <td class="flex justify-end py-2 border-t">
                        <Link class="px-2" :href="this.$route('clients.edit', client.id)" tabindex="-1" title="Edit">
                        <icon name="pencil-square" class="block text-green-600" />
                        </Link>
                        <button title="Delete" class="px-2" @click.prevent="showModal(client.id)">
                            <icon name="trash" class="block text-red-600" />
                        </button>
                    </td>
                </tr>
                <tr v-if="clients.data.length === 0">
                    <td class="px-6 py-4 border-t" colspan="6">
                        No clients found
                    </td>
                </tr>
            </table>
        </div>
        <pagination :links="clients.links" />
    </div>
</template>

<script>
import Icon from "@/Shared/Icon.vue";
import Layout from "@/Shared/Layout.vue";
import mapValues from "lodash/mapValues";
import Pagination from "@/Shared/Pagination.vue";
import pickBy from "lodash/pickBy";
import throttle from "lodash/throttle";
import { Head, Link } from "@inertiajs/vue3";
export default {
    components: {
        Icon,
        Pagination,
    },
    layout: Layout,
    props: {
        clients: Object,
        filters: Object,
    },
    data() {
        return {
            form: {
                search: this.filters.search,
            },
        };
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(
                    this.$route("clients.index"),
                    pickBy(this.form),
                    { preserveState: true }
                );
            }, 150),
        },
    },
    methods: {
        reset() {
            this.form = mapValues(this.form, () => null);
        },
        showModal(id) {
            this.$swal({}).then((result) => {
                if (result.value) {
                    this.$inertia.delete(this.$route("clients.destroy", id));
                }
            });
        },
    },
};
</script>

