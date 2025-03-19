<script setup>
import { usePage, router } from '@inertiajs/vue3'
import { NIcon } from 'naive-ui'
import { ArrowBackOutline } from '@vicons/ionicons5'
const page = usePage()

const back = () => {
    let urlPrev = page.props.urlPrev
    if (urlPrev !== 'empty') {
        router.visit(urlPrev)
    } else {
        window.history.back()
    }
}

</script>

<template>
    <button @click="back" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
        <n-icon size="16" class="align-middle mr-2" color="#fff" :component="ArrowBackOutline"></n-icon>
        <slot />
    </button>
</template>

