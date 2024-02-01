<script setup lang="ts">
interface Props {
    title: string
}

const props = defineProps<Props>();
</script>

<template>
    <h1 class="text-2xl font-bold mb-4">{{ props.title }}</h1>
</template>

