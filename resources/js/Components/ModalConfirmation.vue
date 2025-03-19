<script setup lang="ts">
import { computed, onMounted, onUnmounted, watch } from 'vue';

const props = defineProps<{
    show: boolean,
    mensaje: string,
    aceptar: string,
    color_icono: string,
    color_boton: string,
    color_boton_hover: string,
}>()

const emit = defineEmits<{
    (e: 'result', value: boolean): void
}>()

function emitResult(value: boolean) {
    emit('result', value)
}
onMounted(() => document.addEventListener('keydown', closeOnEscape));
onUnmounted(() => {
    document.removeEventListener('keydown', closeOnEscape);
    document.body.style.overflow = null;
});


const closeOnEscape = (e) => {
    if (e.key === 'Escape' && props.show) {
        emit('result', false)
    }
};

const mensaje = computed(() =>
    props.mensaje
        ? props.mensaje
        : '¿Quieres borrar el registro?'
);

const aceptar = computed(() =>
    props.aceptar
        ? props.aceptar
        : 'Si, borrarlo'
);

const color_icono = computed(() =>
    props.color_icono
        ? props.color_icono
        : 'text-purple-500'
);

const color_boton = computed(() =>
    props.color_boton
        ? props.color_boton
        : 'bg-purple-600'
);
const color_boton_hover = computed(() =>
    props.color_boton_hover
        ? props.color_boton_hover
        : 'bg-purple-800'
);
</script>
<template>
    <teleport to="body">
        <transition leave-active-class="duration-100">
            <div id="popup-modal" v-if="show" tabindex="-1" class="items-center flex justify-center fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto overflow-x-hidden h-full w-full p-4">
                <transition enter-active-class="ease-out duration-300" enter-from-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" enter-to-class="opacity-100 translate-y-0 sm:scale-100" leave-active-class="ease-in duration-200" leave-from-class="opacity-100 translate-y-0 sm:scale-100" leave-to-class="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
                    <div class="relative mx-auto bg-white rounded-lg w-96 shadow dark:bg-gray-700">
                        <div class="p-6 text-center">
                            <svg aria-hidden="true" :class="`mx-auto mb-4 ${color_icono} w-10 h-10 dark:${color_icono}`" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-700 dark:text-gray-400">{{ mensaje }}</h3>
                            <button @click="emitResult(true)" data-modal-hide="popup-modal" type="button" :class="`text-white ${color_boton} hover:${color_boton_hover} focus:ring-4 focus:outline-none font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2`">
                                {{ aceptar }}
                            </button>
                            <button @click="emitResult(false)" data-modal-hide="popup-modal" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">No, cancelar</button>
                        </div>
                    </div>
                </transition>
            </div>
        </transition>
    </teleport>
</template>
