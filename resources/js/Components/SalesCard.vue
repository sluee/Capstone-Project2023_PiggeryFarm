<template>

    <div class='flex items-center justify-center py-5 px-2' >
        <div class='w-full max-w-md  mx-auto  rounded-3xl shadow-xl overflow-hidden'>
            <div class='max-w-md mx-auto'>
            <!-- <div class='h-[236px]' style='background-image:url(https://img.freepik.com/free-photo/pasta-spaghetti-with-shrimps-sauce_1220-5072.jpg?w=2000&t=st=1678041911~exp=1678042511~hmac=e4aa55e70f8c231d4d23832a611004f86eeb3b6ca067b3fa0c374ac78fe7aba6);background-size:cover;background-position:center'>
            </div> -->
            <div class='p-4 sm:p-6'>
                <p class='font-bold text-[20px] leading-7 mb-1'>Customer: {{ sale.customers.name }}</p>
                <div class='flex flex-row'>
                    <p class='text-[15px] font-bold text-[#0FB478]'>Total Amount: {{ sale.total_amount }}</p>

                </div>
                <p class=' font-[15px] mt-4'>Payment: {{ sale.is_credit }}</p>
                <p class='font-[15px] '>Balance: {{ sale.balance }} </p>
                <p class='text-[15px] font-bold text-[#0FB478]'> {{ sale.remarks }}</p>


                <button @click="open(transaction)" class='block mt-10 w-full px-4 py-3 font-medium tracking-wide text-center capitalize transition-colors duration-300 transform bg-[#FFC933] rounded-[14px] hover:bg-[#FFC933DD] focus:outline-none focus:ring focus:ring-teal-300 focus:ring-opacity-80'>
                    View on Sales Invoice
                </button>

            </div>
            </div>
        </div>
    </div>



</template>

<script setup>
import { router } from '@inertiajs/vue3';


const props = defineProps({
    sale: Object,
    customers:Object
})

function open(sale) {
    router.visit('/sales/' + sale.id)
}




</script>
