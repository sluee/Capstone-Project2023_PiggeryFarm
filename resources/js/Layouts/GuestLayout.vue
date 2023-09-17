<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="flex flex-col md:flex-row h-screen items-center justify-center">

        <div class="flex items-start w-[55rem] rounded-xl border border-gray-300 shadow-md">
            <div class="w-1/2 relative">
                <!-- Logo -->
                <slot name="logo"/>
            </div>

            <div class="w-1/2">
                <!-- Login form -->
                <slot name="form" />
            </div>
        </div>
    </div>
</template>
