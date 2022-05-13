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
                                    <h2 class="header">Transactions Table</h2>
                                    <div class='flex justify-between'>
                                    </div>
                                </div>
                                <br />
                                <!-- /.card-header -->
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                                    <form @submit.prevent="form.put(route('transactions.update', transaction.id))">
                                        <div class="form-group mb-6">
                                            <div class="form-group mb-6">
                                            <input type="email" v-model='form.sender' class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="sender"
                                                placeholder="Sender email">

                                            <div class='text-red-500 text-sm italic font-semibold' v-if='errors.sender'>
                                                {{ errors.sender }}
                                            </div>
                                        </div>
                                            <input type="email" v-model='form.receiver' class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="receiver"
                                                placeholder="receiver email">

                                            <div class='text-red-500 text-sm italic font-semibold' v-if='errors.receiver'>
                                                {{ errors.receiver }}
                                            </div>
                                        </div>
                                        <div class="form-group mb-6">
                                            <input type="number" v-model='form.points' class="form-control block
        w-full
        px-3
        py-1.5
        text-base
        font-normal
        text-gray-700
        bg-white bg-clip-padding
        border border-solid border-gray-300
        rounded
        transition
        ease-in-out
        m-0
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="points"
                                                placeholder="points">
                                            <div class='text-red-500 text-sm italic font-semibold' v-if='errors.points'>
                                                {{ errors.points }}
                                            </div>
                                        </div>
                                        <button type="submit" class="
      w-full
      px-6
      py-2.5
      bg-blue-600
      text-white
      font-medium
      text-xs
      leading-tight
      uppercase
      rounded
      shadow-md
      hover:bg-blue-700 hover:shadow-lg
      focus:bg-blue-700 focus:shadow-lg focus:outline-none focus:ring-0
      active:bg-blue-800 active:shadow-lg
      transition
      duration-150
      ease-in-out">Submit</button>
                                    </form>
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
<script>
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
    import {
        Head,
        Link,
        useForm
    } from '@inertiajs/inertia-vue3';
export default {
    components: {
        BreezeAuthenticatedLayout,
        Head,
        Link,
        useForm
    },
    props: {transaction: Object, errors: Object},
    setup(props) {
        const form = useForm({
            sender: props.transaction.sender.email,
            receiver: props.transaction.receiver.email,
            points: props.transaction.points
        });
        return {
            form
        };
    },
}
</script>