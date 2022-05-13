<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/inertia-vue3';
    import VueTailwindPagination from '@ocrv/vue-tailwind-pagination'

    const form = useForm({
        points: '',
        count: '',
        starts_at: '',
        expires_at: ''
    });

</script>

<template>
    <BreezeAuthenticatedLayout>
        <div class="container mx-auto">
            <!-- Content Wrapper. Contains page content -->
            <div class="">
                <br />
                <!-- Main content -->
                <section class="content ">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h2 class="header">Coupons Table</h2>
                                    <div class='flex justify-between'>
                                    <div class="text-left">
                                            <input type="text" class="form-control" v-model="search"/>
                                        </div>
                                        <div class="text-right">
                                            <Button @click='createCoupons = !createCoupons'
                                                class='py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer'>
                                                Add Coupons</Button>
                                        </div>
                                    </div>
                                </div>
                                <br />
                                <!-- /.card-header -->
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">#</th>
                                                <th scope="col" class="px-6 py-3">code</th>
                                                <th scope="col" class="px-6 py-3">Meta data</th>
                                                <th scope="col" class="px-6 py-3">starts at</th>
                                                <th scope="col" class="px-6 py-3">expires at</th>
                                                <th scope="col" class="px-6 py-3">redeemed at</th>
                                                <th scope="col" class="px-6 py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='(voucher, index) in vouchersData.data' :key="index"
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td class="px-6 py-4">{{voucher.id}}</td>
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                    {{voucher.code}}</th>
                                                <td class="px-6 py-4">
                                                    <span>
                                                        Points : {{  voucher.metadata.point }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4"> {{voucher.starts_at}}</td>
                                                <td class="px-6 py-4"> {{voucher.expires_at}}</td>
                                                <td class="px-6 py-4"> {{voucher.redeemed_at}}</td>
                                                <td class="px-6 py-4">
                                                    <button @click="deleteItem(voucher.id)"
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-3 py-1 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col" class="px-6 py-3">#</th>
                                                <th scope="col" class="px-6 py-3">code</th>
                                                <th scope="col" class="px-6 py-3">Meta data</th>
                                                <th scope="col" class="px-6 py-3">starts at</th>
                                                <th scope="col" class="px-6 py-3">expires at</th>
                                                <th scope="col" class="px-6 py-3">redeemed at</th>
                                                <th scope="col" class="px-6 py-3">Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <VueTailwindPagination :current="current" :total="total" :per-page="perPage"
                                    @page-changed="getResults" />
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->

        </div>
        <div class="relative z-10" aria-labelledby="modal-title" role="dialog" aria-modal="true" v-show='createCoupons'>

            <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>

            <div class="fixed z-10 inset-0 overflow-y-auto">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <!-- This element is to trick the browser into centering the modal contents. -->
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <div
                        class="relative inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div
                                    class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <!-- Heroicon name: outline/exclamation -->
                                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50"
                                        style="enable-background:new 0 0 50 50;" xml:space="preserve">
                                        <circle style="fill:#25AE88;" cx="25" cy="25" r="25" />
                                        <polyline
                                            style="fill:none;stroke:#FFFFFF;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;"
                                            points="38,15 22,33 12,25 " />
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                        <g></g>
                                    </svg>

                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Add Coupons
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500">
                                            <form @submit.prevent="form.post(route('admin.points.store'))">
                                                <div class="relative z-0 w-full mb-6 group">
                                                    <input type="number" name="points" v-model="form.points"
                                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " required />
                                                    <label for="points"
                                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                        Points</label>
                                                </div>
                                                <div class="relative z-0 w-full mb-6 group">
                                                    <input type="number" name="count" id="floating_count"
                                                        v-model="form.count"
                                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " required />
                                                    <label for="floating_count"
                                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Code
                                                        Count</label>
                                                </div>
                                                <div class="relative z-0 w-full mb-6 group">
                                                    <input type="date" name="starts_at" id="starts_at"
                                                        v-model="form.starts_at"
                                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                        placeholder=" " required />
                                                    <label for="starts_at"
                                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                        Starts at</label>
                                                </div>
                                                <div class="grid xl:grid-cols-2 xl:gap-6">
                                                    <div class="relative z-0 w-full mb-6 group">
                                                        <input type="date" name="expires_at" id="expires_at"
                                                            v-model="form.expires_at"
                                                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                                            placeholder=" " required />
                                                        <label for="expires_at"
                                                            class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                                            Expires at</label>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Submit</button>
                                            </form>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="button"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm"
                                @click='reset'>Reset</button>
                            <button type="button"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                @click='createCoupons = !createCoupons'>Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
<script>
    export default {
        data() {
            return {
                createCoupons: false,
                vouchersData: {},
                current: 1,
                perPage: 10,
                total: 20,
                search: '',
            }
        },
        setup() {},
        methods: {
            reset() {
                this.form.reset();
            },
        },
        mounted() {
            // Fetch initial results
            this.getResults();
        },
        watch: {
            search: {
                handler(value) {
                    if(value.length > 2) {
                        this.searchResult();
                    } else {
                    this.getResults();
                    }
                },
                immediate: true // This ensures the watcher is triggered upon creation
            }

        },
        methods: {
            // Our method to GET results from a Laravel endpoint
            getResults(page = 1) {
                axios.get('points?page=' + page)
                    .then(response => {
                        this.vouchersData = response.data;
                        this.current = page;
                        this.total = this.vouchersData.total;
                    });
            },
            searchResult() {
                axios.post('points/search', {search: this.search})
                    .then(response => {
                        this.vouchersData = response.data;
                        this.current = 1;
                        this.total = this.vouchersData.total;
                    });
            },
            deleteItem(item_id) {
                this.$inertia.delete(`points/${item_id}`, {
                    onBefore: () => confirm('Are you sure you want to delete this item?'),
                    onSuccess: () => { this.getResults() }
                });
            }
        }
    }

</script>
