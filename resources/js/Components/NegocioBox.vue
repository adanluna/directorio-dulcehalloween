<script setup lang="ts">
import { Link } from '@inertiajs/vue3'
import PrimaryButton from '@/Components/PrimaryButton.vue';

const props = defineProps({
    item: {
        type: Object,
    },
    white: {
        type: Boolean,
        default: true,
    },
});

</script>

<template>
    <div :class="(white) ? 'bg-white' : 'bg-gray-200'">
        <div class="p-3" :style="'background-color:' + item.categoria.bgcolor + ';color:' + item.categoria.color + ';'">{{ item.categoria.nombre }} / {{ item.subcategoria.nombre }}</div>
        <div :style="'border-color:' + item.categoria.bgcolor + ';border-bottom-width: 6px;'">
            <Link class="" :href="route('negocio', item.slug)">
            <div class="h-64 bg-cover" :style="'background-image: url(' + $urlImages + item.foto1 + ');'"></div>
            </Link>
        </div>
        <div class="">
            <div class="p-5">
                <Link :href="route('negocio', item.slug)"><span class="block font-bold text-black text-2xl garamond">{{ item.nombre }}</span></Link>
                <div class="py-3 text-sm text-purple-800">{{ item.horario }}<br>{{ item.horario_fin }}</div>
                <div class="">{{ $filters.truncate(item.descripcion, 200, '...') }}</div>
                <div class="pt-4">
                    <PrimaryButton :href="route('negocio', item.slug)" :color="item.categoria.color" :bgcolor="item.categoria.bgcolor">
                        Mas información
                    </PrimaryButton>
                </div>
            </div>
        </div>
    </div>
</template>
