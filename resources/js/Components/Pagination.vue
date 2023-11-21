<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array
})
</script>

<template>
    <div>
        <div class="flex flex-wrap-mb-1">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 bg-white text-gray-400 border rounded"
                    v-html="link.label"></div>
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded  hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'bg-blue-200 border-indigo-500': link.active }" :href="link.url" v-html="link.label"></Link>
            </template>
        </div>
    </div>
</template>
