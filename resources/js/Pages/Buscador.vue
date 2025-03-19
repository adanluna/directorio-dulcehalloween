<script setup>
import { useForm } from '@inertiajs/vue3'
import NegocioBox from '@/Components/NegocioBox.vue';
import Paginacion from '@/Components/Paginacion.vue'
import EmptyBusqueda from '@/Components/Messages/EmptyBusqueda.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'
library.add(faMagnifyingGlass)

</script>

<template>

    <Head title="Buscador" />
    <section class="border-t border-gray-200">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-10 lg:px-0 ">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-16 flex flex-col items-center">
                <h2 class="mb-3 text-4xl tracking-tight font-extrabold text-purple-800">Búsqueda de negocios</h2>
                <form @submit.prevent="submit" class="md:w-full md:text-xl">
                    <input class="md:w-1/2 w-1/2 border-y border-l border-black rounded-l-full pl-6 pr-4 py-2" required v-model="form.q" placeholder="">
                    <button class="border text-white bg-purple-600 border-black rounded-r-full pl-6 pr-8 py-2" type="submit">
                        <font-awesome-icon :icon="['fas', 'magnifying-glass']" /> Buscar
                    </button>
                    <div v-if="form.errors.q">{{ form.errors.q }}</div>
                </form>
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

<style scoped></style>

<script>
export default {
    props: {
        categorias: Object,
        negocios: Object,
        q: String,
    },
    data() {
        return {
            form: useForm({
                q: this.q,
            }),
        }
    },
    methods: {
        submit() {
            this.form.get(route('buscar'))
        },
    },
}
</script>
