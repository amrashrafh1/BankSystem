<script setup>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/inertia-vue3';

    defineProps({
        prize: Object,
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
                                    <h2 class="header">Prizes Table</h2>
                                    <div class='flex justify-between'>
                                    </div>
                                </div>
                                <br />
                                <!-- /.card-header -->
                                <div class="relative overflow-x-auto sm:rounded-lg m-auto">
                                    <div class="py-6">
                                        <div class="flex max-w-md bg-white shadow-lg rounded-lg overflow-hidden m-auto">
                                            <div class="p-4 w-full">
                                                <h1 class="text-gray-900 font-bold text-2xl ">{{prize.name}}</h1>
                                                <p class="mt-2 text-gray-600 text-sm ">{{prize.description}}
                                                </p>
                                                <div class="flex item-center justify-between mt-3">
                                                    <h1 class="text-gray-700 font-bold text-xl">Price: <span class='text-green-600'>{{prize.price}} point </span></h1>
                                                    <Link :href="route('admin.prizes.edit', prize.id)"
                                                        class="px-3 py-2 bg-blue-600 text-white text-xs font-bold uppercase rounded">Edit Prize</Link>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br/>
                                    <h1>Who buy this prize</h1>
                                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 ">
                                        <thead
                                            class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                            <tr>
                                                <th scope="col" class="px-6 py-3">#</th>
                                                <th scope="col" class="px-6 py-3">Name</th>
                                                <th scope="col" class="px-6 py-3">Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for='(user, index) in prize.users' :key="index"
                                                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                                <td class="px-6 py-4">{{user.id}}</td>
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                    {{user.name}}</th>
                                                <th scope="row"
                                                    class="px-6 py-4 font-medium text-gray-900 dark:text-white whitespace-nowrap">
                                                    {{user.email}}</th>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th scope="col" class="px-6 py-3">#</th>
                                                <th scope="col" class="px-6 py-3">Name</th>
                                                <th scope="col" class="px-6 py-3">Email</th>

                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
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
