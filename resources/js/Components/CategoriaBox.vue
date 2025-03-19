<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import { defineComponent, computed } from 'vue'
</script>

<template>
    <Link :href="route('negocios', {categoria: item.slug})">
    <div class="text-center">
        <div class="rounded-2xl h-64 bg-cover" :style="'background-image: url(/storage/' + item.fotografia + ');'">
        </div>
        <span class="block font-bold text-black text-2xl mt-2">{{ item.nombre }}</span>
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
