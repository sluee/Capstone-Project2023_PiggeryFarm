<template>
    <Head title="View Customer" />

    <SideBarLayout>
        <template #header>
            <div class="flex">
                <h2 class="flex-1 font-semibold text-xl text-gray-800 leading-tight">View Customer</h2>
                <Link class="button1 mb-2 py-2 px-3 bg-gray-300 shadow border-gray-300 border hover:bg-gray-400 rounded mr-3" as="button" :href="'/customers/'">Back</Link>
            </div>
        </template>

        <div class="py-12 ">
            <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 ">
                <div class="bg-white  shadow-lg sm:rounded-lg">
                    <div class="p-6 text-gray-900 flex">

                        <div class="flex-1 ml-4 bg-">
                            <div class="flex">
                                <h3 class="text-2xl flex-1 ">Details of Customer</h3>

                            </div>
                            <hr>
                            <div class="mt-2" ><strong>Customer:</strong>  {{ customer.name }} </div>
                            <div class="mt-2" ><strong>Address</strong>  {{customer.address }} </div>
                            <div class="mt-2"><strong>Phone</strong> {{ customer.phone }}</div>
                           
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </SideBarLayout>
</template>

<script setup>
import SideBarLayout from '@/Layouts/SideBarLayout.vue';
import moment from 'moment'
// import { ref } from 'vue';
import {Head, Link, useForm} from '@inertiajs/vue3'

const props = defineProps({
    customer: Object,
    sale:Object,
    

})

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}

function reheatBreeding() {
      // Make a POST request to the Laravel route for reheat
     route.visit('breedings.reheat', { id: this.breeding.id })
        .then(() => {
          // Optionally, you can reload the page or update the component data
          // This depends on your application's needs.
          // For example, you can use `this.$inertia.reload()` to refresh the page.
        });
    }


</script>
