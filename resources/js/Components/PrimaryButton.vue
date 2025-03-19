<script setup>
import { Link } from '@inertiajs/vue3';
defineProps({
    href: {
        type: String,
        default: '',
    },
    color:{
        type: String,
        default: '#000',
    },
    bgcolor:{
        type: String,
        default: '#fff',
    }
});
</script>
<template>
 <Link
        :href="href"
        :disabled="disabled"
        class="text-base inline-flex px-6 py-1 items-center rounded-r-full" :style="'background-color: '+bgcolor+';color:'+color+';'"
    >
        <slot/>
    </Link>
</template>
