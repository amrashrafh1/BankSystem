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
                                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

                                    <form @submit.prevent="form.put(route('admin.prizes.update', prize.id))">
                                        <div class="form-group mb-6">
                                            <input type="text" v-model='form.name' class="form-control block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput7"
                                                placeholder="Name">

                                            <div class='text-red-500 text-sm italic font-semibold' v-if='errors.name'>
                                                {{ errors.name }}
                                            </div>
                                        </div>
                                        <div class="form-group mb-6">
                                            <input type="number" v-model='form.price' class="form-control block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" id="exampleInput8"
                                                placeholder="price">
                                            <div class='text-red-500 text-sm italic font-semibold' v-if='errors.price'>
                                                {{ errors.price }}
                                            </div>
                                        </div>
                                        <div class="form-group mb-6">
                                            <textarea v-model='form.description' class="
        form-control
        block
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
        focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none
      " id="exampleFormControlTextarea13" rows="1" placeholder="description"></textarea>
                                            <div class='text-red-500 text-sm italic font-semibold'
                                                v-if='errors.description'>
                                                {{ errors.description }}
                                            </div>
                                        </div>
                                        <div class="form-group mb-6">
                                            <select v-model='form.visible' class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none">
                                                <option value="1">true</option>
                                                <option value="0">false</option>
                                            </select>
                                            <div class='text-red-500 text-sm italic font-semibold' v-if='errors.name'>
                                                    {{ errors.name }}
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
    props: {prize: Object, errors: Object},
    setup(props) {
        const form = useForm(props.prize);
        return {
            form
        };
    },
}
</script>