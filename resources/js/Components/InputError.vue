<script setup lang="ts">
defineProps({
    message: {
        type: String,
    },
});
</script>

<template>
    <div v-show="message">
        <p class="text-sm text-purple-600">
            {{ message }}
        </p>
    </div>
</template>
