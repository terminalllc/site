<template>
    <div>

        <Head title="Users" />
        <h1 class="mb-8 text-3xl font-bold">Users</h1>
        <div class="flex items-center justify-end mb-6">
            <Link class="btn-green text-white" :href="this.$route('users.create')">
            <span>Create</span>
            </Link>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="whitespace-no-wrap w-full">
                <tr class="text-left font-bold bg-gray-400">
                    <th class="px-4">#</th>
                    <th class="px-4">Name</th>
                    <th class="px-4">Email</th>
                    <th class="pb-12 px-4" />
                </tr>
                <tr v-for="(user, index) in users.data" :key="user.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
                    <td class="px-4 py-3 w-2 border-t">
                        {{ index + 1 }}
                    </td>
                    <td class="px-4 border-t">
                        {{ user.name }}
                    </td>
                    <td class="px-4 border-t">
                        {{ user.email }}
                    </td>
                    <td class="flex justify-end py-2 border-t">
                        <Link class="px-2" :href="this.$route('users.edit', user.id)" tabindex="-1" title="Edit">
                        <icon name="pencil-square" class="block text-green-600" />
                        </Link>
                        <button title="Delete" class="px-2" @click.prevent="showModal(user.id)">
                            <icon name="trash" class="block text-red-600" />
                        </button>
                    </td>
                </tr>
                <tr v-if="users.data.length === 0">
                    <td class="px-6 py-4 border-t" colspan="6">
                        No users found
                    </td>
                </tr>
            </table>
        </div>
        <pagination :links="users.links" />
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
        users: Object,
    },
    watch: {
        form: {
            deep: true,
            handler: throttle(function () {
                this.$inertia.get(
                    this.$route("users.index"),
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
                    this.$inertia.delete(this.$route("users.destroy", id));
                }
            });
        },
    },
};
</script>

