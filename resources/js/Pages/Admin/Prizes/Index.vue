<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import {
        Head,
        Link
        } from '@inertiajs/inertia-vue3';
    import VueTailwindPagination from '@ocrv/vue-tailwind-pagination'


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
                                    <h2 class="header">Prizes Table</h2>
                                    <div class='flex justify-between'>
                                    <div class="text-left">
                                            <input type="text" class="form-control" v-model="search" placeholder='Search for prizes ...'/>
                                        </div>
                                        <div class="text-right">
                                            <Link :href='route("admin.prizes.create")'
                                                class='py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer'>
                                                Add Prize</Link>
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
                                                <th scope="col" class="px-6 py-3">Name</th>
                                                <th scope="col" class="px-6 py-3">Price</th>
                                                <th scope="col" class="px-6 py-3">Visible</th>
                                                <th scope="col" class="px-6 py-3">Created at</th>
                                                <th scope="col" class="px-6 py-3">Updated at</th>
                                                <th scope="col" class="px-6 py-3">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='(prize, index) in prizes.data' :key="index"
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td class="px-6 py-4">{{prize.id}}</td>
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                    {{prize.name}}</th>
                                                <td class="px-6 py-4">{{prize.price}}</td>
                                                <td :class="[prize.visible ? 'text-green-600' : 'text-red-600']" class='px-6 py-4'>{{(prize.visible) ? 'visible': 'hidden'}}</td>
                                                <td class="px-6 py-4"> {{new Date().toDateString(prize.created_at)}}</td>
                                                <td class="px-6 py-4"> {{new Date().toDateString(prize.updated_at)}}</td>
                                                <td class="px-6 py-4">
                                                    <Link :href='route("admin.prizes.show", prize.id)'
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-3 py-1 bg-orange-400 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Show</Link>
                                                    <Link :href='route("admin.prizes.edit", prize.id)'
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-3 py-1 bg-blue-400 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Edit</Link>
                                                    <button @click="deleteItem(prize.id)"
                                                        class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-3 py-1 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                                    Delete</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col" class="px-6 py-3">#</th>
                                                <th scope="col" class="px-6 py-3">Name</th>
                                                <th scope="col" class="px-6 py-3">Price</th>
                                                <th scope="col" class="px-6 py-3">Visible</th>
                                                <th scope="col" class="px-6 py-3">Created at</th>
                                                <th scope="col" class="px-6 py-3">Updated at</th>
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
    </BreezeAuthenticatedLayout>
</template>
<script>
    export default {
        data() {
            return {
                createCoupons: false,
                prizes: {},
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
                axios.get('prizes?page=' + page)
                    .then(response => {
                        this.prizes = response.data;
                        this.current = page;
                        this.total = this.prizes.total;
                    });
            },
            searchResult() {
                axios.post('prizes/search', {search: this.search})
                    .then(response => {
                        this.prizes = response.data;
                        this.current = 1;
                        this.total = this.prizes.total;
                    });
            },
            deleteItem(item_id) {
                this.$inertia.delete(`prizes/${item_id}`, {
                    onBefore: () => confirm('Are you sure you want to delete this item?'),
                    onSuccess: () => { this.getResults() }
                });
            }
        }
    }

</script>
