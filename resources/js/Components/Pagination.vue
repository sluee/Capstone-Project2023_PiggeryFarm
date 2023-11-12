<!-- <script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    links: Array
})

</script>

<template>
    <div class="flex">
        <Link href="#"
            :is="link.url ? 'Link' : 'span' "
            v-for="link in links"
            :href="link.url"
            v-html="link.label"
            class="mx-1 flex  h-9 w-9 items-center justify-center rounded-full border border-blue-gray-100 bg-transparent p-0 text-sm text-blue-gray-500 transition duration-150 ease-in-out hover:bg-light-300"
            :class="{ 'text-gray-500': ! link.url, 'font-bold text-xl text-black' : link.active}"
        />

    </div>
</template> -->
<script setup>
import { Link } from '@inertiajs/vue3';

defineProps({
    links: Array
})
</script>

<template>
    <div>
        <div class="flex flex-wrap -mb-1">
            <template v-for="(link, p) in links" :key="p">
                <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                    v-html="link.label"></div>
                <Link v-else
                    class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                    :class="{ 'border-indigo-500': link.active }" :href="link.url" v-html="link.label"></Link>
            </template>
        </div>
    </div>
</template>