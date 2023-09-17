<template>
    <div>

    </div>
</template>

<script setup>

import moment from "moment";

function formattedDate(date){
    return moment(date).format('MMMM   D, YYYY');
}
</script>
