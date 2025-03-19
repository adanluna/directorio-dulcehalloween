<script setup lang="ts">
import Menu from '@/Components/Menu.vue'
</script>
<template>

    <div class="sticky top-0 z-50">
        <Menu :categorias="categorias" />
    </div>
    <div class="min-h-screen back-page">
        <slot></slot>
    </div>

    <footer class="back-top body-font shadow-sm">
        <div class="px-5 py-8 sm:grid sm:grid-cols-3">
            <div class="flex justify-center"><img src="/images/logo.png" alt="" style="height:50px !important;" /></div>
            <span class="flex justify-center sm:justify-end items-center">
                <a href="https://www.santiago.gob.mx/descargas/avisodeprivacidad.pdf" target="_blank" class="sm:ml-3 text-gray-500">
                    Aviso de Privacidad
                </a>
                <a href="https://www.santiago.gob.mx/te_escuchamos" class="ml-3 text-gray-500">
                    Contáctanos
                </a>
            </span>
        </div>
    </footer>
</template>

<script lang="ts">
import { defineComponent } from 'vue'

export default defineComponent({
    data() {
        return {
            categorias: [],
        };
    },
    mounted() {
        this.axios
            .get(route('get.categorias'))
            .then(response => {
                this.categorias = response.data;
            });
    }
})
</script>
