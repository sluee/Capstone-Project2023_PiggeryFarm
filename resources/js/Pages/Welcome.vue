<script setup>
import { Head, Link } from '@inertiajs/vue3';

defineProps({
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
    },
    laravelVersion: {
        type: String,
        required: true,
    },
    phpVersion: {
        type: String,
        required: true,
    },
});
</script>

<template>
    <Head title="Welcome" />

    <!-- <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white"
    >
        <div v-if="canLogin" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Log in</Link
                >

                <Link
                    v-if="canRegister"
                    :href="route('register')"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500"
                    >Register</Link
                >
            </template>
        </div>

        <div class="max-w-7xl mx-auto p-6 lg:p-8">

        </div>
    </div> -->
    <!-- relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white -->
    <div class="relative isolate overflow-hidden border-b border-t min-h-screen bg-blue-500 px-6 py-24 sm:py-32 lg:px-8">
        <div
          class="absolute inset-0 -z-10 bg-[radial-gradient(45rem_50rem_at_top,theme(colors.indigo.100),black)] opacity-20">
        </div>
        <div
          class="absolute inset-y-0 right-1/2 -z-10 mr-16 w-[200%] origin-bottom-left skew-x-[-30deg] bg-white shadow-xl shadow-indigo-600/10 ring-1 ring-indigo-50 sm:mr-28 lg:mr-0 xl:mr-16 xl:origin-center">
        </div>

        <div class="max-w-7xl py-12 mx-auto px-6 md:px-12 xl:px-6 ">
            <div class="relative">

                <div class="flex items-center justify-center -space-x-2">
                    <img loading="lazy" width="400" height="400" src="https://img.freepik.com/free-vector/pig-cartoon-character-logo-pork-products_1308-109964.jpg?w=900&t=st=1700189405~exp=1700190005~hmac=afda7a72095fc50e1b4b12a47d40908622c536cfeef2a0f65b812192ea02c641" alt="member photo" class="h-8 w-8 rounded-full object-cover">
                    <img loading="lazy" width="200" height="200" src="https://img.freepik.com/free-vector/cute-pig-sitting-cartoon-vector-icon-illustration-animal-nature-icon-concept-isolated-premium-flat_138676-7818.jpg?w=740&t=st=1700189502~exp=1700190102~hmac=e6dca052a0df6ff99a014e989d436f891565623c086659072a8f99006a183c21" alt="member photo" class="h-12 w-12 rounded-full object-cover">
                    <img loading="lazy" width="200" height="200" src="/images/logo.png" alt="member photo" class="z-10 h-20 w-20 rounded-full object-cover">
                    <img loading="lazy" width="200" height="200" src="https://img.freepik.com/free-vector/cute-pig-standing-cartoon-vector-icon-illustration-animal-nature-icon-concept-isolated-premium-flat_138676-7292.jpg?w=740&t=st=1700189448~exp=1700190048~hmac=09f645ca630c87e9ea2174eb9dec2f6f494154860c44441e6f512e4787523953" alt="member photo" class="relative h-12 w-12 rounded-full object-cover">
                    <img loading="lazy" width="200" height="200" src="https://img.freepik.com/free-vector/cute-pig-summer-waving-hand-cartoon-vector-icon-illustration-animal-holiday-icon-concept-isolated_138676-7161.jpg?w=740&t=st=1700189473~exp=1700190073~hmac=80f292dcdb5ef481f85cdf4c8ded007bc3f8e4ab5b1aaca6b5d9fa021c8bb086" alt="member photo" class="h-8 w-8 rounded-full object-cover">
                </div>

                <div class="mt-6 m-auto space-y-6 md:w-8/12 lg:w-7/12">
                    <h1 class="text-center text-4xl font-bold text-gray-800 md:text-5xl">RQR Piggery Farm
                    </h1>
                    <p class="text-center text-xl text-gray-600">
                        Happy oinks, happy hearts: Welcome to our joy-filled piggery paradise!
                    </p>
                    <div class="flex flex-wrap justify-center gap-6">
                        <Link
                        :href="route('login')"
                        class="relative flex h-12 w-full items-center justify-center px-10 before:absolute before:inset-0 before:rounded-full before:bg-white before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max">
                        <span class="relative text-base font-semibold text-blue-700 dark:text-dark">Login</span>

                        </Link>
                        <!-- <Link
                        :href="route('login')"
                        class="relative flex h-12 w-full items-center justify-center px-8 before:absolute before:inset-0 before:rounded-full before:bg-teal-500 before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max">
                        <span class="relative text-base font-semibold text-white dark:text-dark">Login</span>

                        </Link> -->


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<!-- <style>
.bg-dots-darker {
    background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(0,0,0,0.07)'/%3E%3C/svg%3E");
}
@media (prefers-color-scheme: dark) {
    .dark\:bg-dots-lighter {
        background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
    }
}
</style> -->
