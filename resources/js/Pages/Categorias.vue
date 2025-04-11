<script setup>
import { Link } from '@inertiajs/vue3'
import NegocioBox from '@/Components/NegocioBox.vue';
import Paginacion from '@/Components/Paginacion.vue'
import EmptyBusqueda from '@/Components/Messages/EmptyBusqueda.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'
library.add(faMagnifyingGlass)

</script>

<template>

    <Head :title="categoria.nombre + ((subcategoria !== null) ? ' - ' + subcategoria?.nombre : '')" />
    <section class="border-t border-gray-200">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-10 lg:px-0 ">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-10 flex flex-col items-center">
                <h2 class="mb-3 text-4xl tracking-tight font-extrabold text-purple-800 garamond">{{ categoria.nombre }}</h2>
                <ul class="subcategorias mt-3 flex flex-col md:block" v-if="subcategorias.length > 0">
                    <li class="mr-6">
                        <Link :href="route('negocios', { 'categoria': categoria.slug })" :class="(subcategoria == null) ? 'font-bold underline' : ''" class="text-black hover:text-purple-800">Todas</Link>
                    </li>
                    <li v-for="(item, index) in subcategorias" :key="index" class="mr-6">
                        <Link :href="route('negocios', { 'categoria': categoria.slug, 'subcategoria': item.slug })" :class="(subcategoria?.slug == item.slug) ? 'font-bold underline' : ''" class="text-black hover:text-purple-800">{{ item.nombre }}</Link>
                    </li>
                </ul>
            </div>
            <div v-if="negocios.data.length > 0">
                <div class="grid md:px-5 gap-8 mb-6 grid-cols-1 md:grid-cols-3 auto-cols-max">
                    <NegocioBox v-for="(item, index) in negocios.data" :key="index" :item="item" />
                </div>
                <Paginacion class="mt-4" :links="negocios.links" />
            </div>
            <EmptyBusqueda v-if="negocios.data.length < 1" />
        </div>

    </section>
</template>

<style scoped>
.subcategorias li {
    float: left;
}
</style>
<script>
export default {
    props: {
        categoria: Object,
        subcategorias: Object,
        subcategoria: Object,
        negocios: Object,
        q: String,
    },
    data() {
        return {
        }
    },
    methods: {
    },
}
</script>
