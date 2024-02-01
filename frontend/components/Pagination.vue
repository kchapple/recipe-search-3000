<script setup lang="ts">
import { computed } from 'vue';
import { PaginationMeta, PaginationLinks } from "../models/api";

interface Props {
    meta: PaginationMeta,
    links: PaginationLinks
}

const props = defineProps<Props>();
const emits = defineEmits<{
    change: [id: number]
    update: [value: string]
}>();


const currentPage = computed(() => props.meta?.current_page || 1);
const lastPage = computed(() => props.meta?.last_page || 1);
const changePage = (newPage) => {
    emits('change', newPage);
};
</script>

<template>
    <div class="pagination">
        <button @click="changePage(currentPage - 1)" :disabled="currentPage === 1">
            Previous
        </button>

        <span>Page {{ currentPage }} of {{ lastPage }}</span>

        <button @click="changePage(currentPage + 1)" :disabled="currentPage === lastPage">
            Next
        </button>
    </div>
</template>

<style scoped>
.pagination {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
}

button {
    padding: 5px 10px;
    cursor: pointer;
}
</style>
