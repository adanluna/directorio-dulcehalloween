<script setup>
defineProps({
    value: {
        type: String,
    },
});
</script>

<template>
    <label class="block font-medium text-base text-gray-700 mb-3">
        <span v-if="value">{{ value }}</span>
        <span v-else><slot /></span>
    </label>
</template>
