<script setup>
import { useForm } from '@inertiajs/vue3'
import CategoriaBox from '@/Components/CategoriaBox.vue';
import NegocioBox from '@/Components/NegocioBox.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { library } from '@fortawesome/fontawesome-svg-core'
import { faMagnifyingGlass } from '@fortawesome/free-solid-svg-icons'
library.add(faMagnifyingGlass)

</script>

<template>

    <Head title="Directorio Dulce Halloween" />
    <div class="">
        <section class="bg_color bg-center bg-cover">
            <div class="flex flex-row h-128 items-center">

            </div>
        </section>
    </div>

    <section class="">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-10 lg:px-0 ">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-16">
                <p class="font-light mb-10 text-2xl garamond">¡Descubre los mejores negocios para Halloween en un solo lugar! Encuentra dulces, disfraces, decoraciones y más en nuestro directorio especial para este día espeluznante. <br>🎃👻 ¡Haz que tu Halloween sea inolvidable!</p>
                <h2 class="mb-3 text-4xl tracking-tight font-extrabold text-purple-800 garamond">Explora el Directorio Halloween 🎃</h2>
            </div>
            <div class="grid md:px-5 gap-8 mb-6 grid-cols-1 md:grid-cols-3 auto-cols-max">
                <CategoriaBox v-for="(item, index) in categorias" :key="index" :item="item" />
            </div>
        </div>
    </section>

    <section class="bg-purple-200 text-center">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-10 lg:px-0 ">
            <h2 class="text-4xl tracking-tight font-extrabold text-purple-800 garamond"> Buscar Negocios</h2>
            <p class="font-light mb-10 sm:text-lg">Por nombre o palabra clave</p>
            <div class="flex justify-center">
                <form :action="route('buscar')" method="get" class="md:w-1/2 md:text-2xl">
                    <input class="md:w-1/2 w-1/2 border-y border-l border-black rounded-l-full pl-6 pr-4 py-2" name="q" required placeholder="">
                    <button class="border text-white back-top border-black rounded-r-full pl-6 pr-8 py-2" type="submit">
                        <font-awesome-icon :icon="['fas', 'magnifying-glass']" /> Buscar
                    </button>
                </form>
            </div>
        </div>

    </section>

    <section class="border-t bg-white">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-10 lg:px-0 ">
            <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-16">
                <h2 class="mb-3 text-4xl tracking-tight font-extrabold text-purple-800 garamond">Negocios recién agregados</h2>
            </div>
            <div class="grid md:px-5 gap-8 mb-6 grid-cols-1 md:grid-cols-3 auto-cols-max">
                <NegocioBox v-for="(item, index) in recientes" :key="index" :item="item" />
            </div>
        </div>
    </section>

    <div class=" bg-purple-100 py-12 sm:py-12 bg-no-repeat bg-right" style="background-image: url(/images/que-es.png);">
        <div class="mx-auto max-w-7xl px-8 2xl:px-0 flex">
            <div class="sm:basis-1/2 p-6 text-lg md:p-0">
                <h2 class="mb-10 text-4xl tracking-tight font-extrabold text-gray-900 garamond">¿Qué es Directorio Dulce Halloween?</h2>
                <p class="font-light text-gray-800 sm:text-lg pb-6">¿Tienes un negocio para Halloween? 🎃 ¡Inscríbete gratis en nuestro directorio y llega a miles de personas que buscan dulces, disfraces y diversión! Aumenta tu visibilidad este Halloween y atrae más clientes. 👻 ¡Únete hoy!</p>
                <p class="font-bold text-gray-800 sm:text-lg pb-6">Inscríbete es muy sencillo</p>
                <PrimaryButton :href="route('inscripcion')" color="#fff" bgcolor="#6A1090FF">
                    Inscríbete ahora
                </PrimaryButton>
            </div>
        </div>
    </div>
</template>

<style scoped>
.bg_color {
    background-image: url(/images/portada.png);
}
</style>

<script>
export default {
    props: {
        categorias: Object,
        recientes: Object,
        errors: Object,
    },
    data() {
        return {
            form: useForm({
                q: null,
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
