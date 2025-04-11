<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { defineComponent, computed } from 'vue'
</script>

<template>
    <Link :href="route('negocios', { categoria: item.slug })">
    <div class="text-center">
        <div class="rounded-2xl h-32 md:h-64 bg-contain bg-no-repeat bg-center" :style="'background-image: url(' + $urlImages + item.fotografia + ');'">
        </div>
        <span class="block font-bold text-black text-3xl mt-2 garamond">{{ item.nombre }}</span>
    </div>
    </Link>
</template>


<script lang="ts">
export default defineComponent({
    props: {
        item: Object,
    }
})
</script>
