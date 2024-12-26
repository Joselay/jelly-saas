<template>
    <div
        v-if="isLoading"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    >
        <img :src="loadingImage" :alt="loadingAlt" />
    </div>
</template>

<script setup lang="ts">
import { defineProps } from "vue";

defineProps({
    isLoading: Boolean,
    loadingImage: {
        type: String,
        default: "/icons/loading.gif",
    },
    loadingAlt: {
        type: String,
        default: "Loading",
    },
});
</script>
