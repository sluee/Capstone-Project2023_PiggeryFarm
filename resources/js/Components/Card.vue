<script setup>

</script>

<template>
    <div class=" ml-8 w-96 rounded-lg bg-gray-100 ">

        <div >
            <slot name="head"></slot>

        </div>
        <div >
            <slot name="content"></slot>
        </div>

        <div >
            <slot name="footer"></slot>
        </div>
    </div>
</template>

<style scoped>


</style>