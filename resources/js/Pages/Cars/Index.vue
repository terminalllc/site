<template>
    <div>

        <Head title="Cars" />
        <h1 class="mb-8 text-3xl font-bold">Cars</h1>
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <div class="flex w-full bg-white rounded shadow">
                    <input v-model="form.search" class="relative px-6 py-3 w-full rounded focus:shadow-outline"
                        autocomplete="off" type="text" name="search" placeholder="Search..."
                        @input="$emit('input', $event.target.value)" />
                </div>
                <icon v-if="form.search?.length > 0" name="x-mark" class="text-red-600 ml-3" @click="reset" />
            </div>
            <Link class="btn-green text-white" :href="this.$route('cars.create')">
            <span>Create</span>
            </Link>
        </div>
        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="whitespace-no-wrap w-full">
                <tr class="text-left font-bold bg-gray-400">
                    <th class="px-4">#</th>
                    <th class="px-4">Name</th>
                    <th class="px-4">VIN</th>
                    <th class="px-4">Client</th>
                    <th class="px-4">Amount</th>
                    <th class="px-4">Payment status</th>
                    <th class="px-4">Comment</th>
                    <th class="px-4">Files</th>
                    <th class="px-4">Status</th>
                    <th class="pb-12 px-4" />
                </tr>
                <tr v-for="(car, index) in cars.data" :key="car.id" class="hover:bg-gray-100 focus-within:bg-gray-100" :class="car.presentImages ? `bg-green-200` : ``">
                    <td class="px-4 py-3 w-2 border-t">
                        {{ index + 1 }}
                    </td>
                    <td class="px-4 border-t">
                        {{ car.name }}
                    </td>
                    <td class="px-4 border-t">
                        {{ car.vin }}
                    </td>
                    <td class="px-4 border-t">
                        {{ car.client }}
                    </td>
                    <td class="px-4 border-t">
                        {{ car.payment_summa }}
                    </td>
                    <td class="px-4 border-t" :class="car.payment_status !== 'Paid' ? ' bg-rose-600' : ''">
                        {{ car.payment_status }}
                    </td>
                    <td class="px-4 border-t">
                        {{ car.comment }}
                    </td>
                    <td class="px-4 border-t">
                        <!-- <td class="px-4 max-w-56 border-t truncate hover:text-clip hover:max-w-80"> -->
                        <a v-if="car.power_of_attorney_delivery" :href="car.power_of_attorney_delivery" target="_blank" download class="underline py-1">
                            <Icon name="download"></Icon>
                            {{ car.power_of_attorney_delivery.replace('/storage/', '').replace('.pdf', '') }}
                        </a>
                        <br>
                        <a v-if="car.power_of_attorney_import" :href="car.power_of_attorney_import" target="_blank" download class="underline py-1">
                            <Icon name="download"></Icon>
                            {{ car.power_of_attorney_import.replace('/storage/', '').replace('.pdf', '') }}
                        </a>
                    </td>
                    <td class="px-4 border-t">
                        {{ car.status }}
                    </td>
                    <td class="flex justify-end py-2 border-t">
                        <button title="Payment" class="px-2"
                            @click.prevent="changeStatusPayment(car.id)">
                            <icon name="banknotes" class="block text-rose-600" />
                        </button>
                        <Link class="px-2" :href="this.$route('cars.edit', car.id)" tabindex="-1" title="Edit">
                        <icon name="pencil-square" class="block text-green-600" />
                        </Link>
                        <button title="Delete" class="px-2" @click.prevent="showModal(car.id)">
                            <icon name="trash" class="block text-red-600" />
                        </button>
                    </td>
                </tr>
                <tr v-if="cars.data.length === 0">
                    <td class="px-6 py-4 border-t" colspan="9">
                        No cars found
                    </td>
                </tr>
            </table>
        </div>
        <pagination :links="cars.links" />
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
        cars: Object,
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
                    this.$route("cars.index"),
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
                    this.$inertia.delete(this.$route("cars.destroy", id));
                }
            });
        },
        changeStatusPayment(id) {
            this.$swal({
                title: 'Are you sure you want to change your payment status?',
            }).then((result) => {
                if (result.value) {
                    this.$inertia.put(this.$route("cars.changeStatusPayment", id));
                }
            });
        },
    },
};
</script>

