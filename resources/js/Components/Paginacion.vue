<template>

    <nav class="flex justify-center pt-4">
        <ul class="inline-flex items-center">
            <li v-for="(link, index) in links" :key="index">
                <component
                    :is="(link.url) ? 'Link' : 'span'"
                    :class="{
                        'rounded-l-lg':(link.label.search(/laquo;/)>-1),
                        'rounded-r-lg':(link.label.search(/raquo;/)>-1),
                        'bg-gray-300': link.active,
                        'text-gray-300 hover:text-gray-300 border-gray-200 hover:bg-white': !link.url
                    }"
                    class="text-sm md:text-base px-3 py-2 leading-tight text-gray-800 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    :href="link.url"
                    v-html="link.label" />
            </li>
        </ul>
    </nav>
</template>

<script>
import { Link } from '@inertiajs/vue3'

export default {
    props: {
        links: Object,
    },
    components: {
        Link
    },
    methods:{
        getClass(){

        }
    }
}
</script>
<style scoped>
span{
    color: #A3A3A3 !important;
    cursor: default;
}
</style>
