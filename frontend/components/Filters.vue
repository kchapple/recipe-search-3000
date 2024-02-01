<script setup lang="ts">
import { ref, watchEffect } from 'vue';

interface Props {
    authorEmail: string,
    keyword: string,
    ingredient: string
}

const props = defineProps<Props>();
const emits = defineEmits<{
    changed: Props
}>();

const localAuthorEmail = ref(props.authorEmail);
const localKeyword = ref(props.keyword);
const localIngredient = ref(props.ingredient);

const clearFilters = () => {
    localAuthorEmail.value = '';
    localKeyword.value = '';
    localIngredient.value = '';
}

watchEffect(() => {
    emits('changed', {
        authorEmail: localAuthorEmail.value,
        keyword: localKeyword.value,
        ingredient: localIngredient.value
    });
});

</script>

<template>
    <div class="mx-auto bg-white border border-gray-300 shadow-md overflow-hidden mb-4">
        <div class="p-6 flex flex-wrap">
            <div class="mb-4 flex items-center">
                <div class="flex flex-col">
                    <input
                        id="authorEmail"
                        placeholder="exact author email..."
                        v-model="localAuthorEmail"
                        type="text"
                        class="border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                    <label for="authorEmail" class="text-gray-700 text-sm font-bold mt-1">Author Email</label>
                </div>
            </div>
            <div class="mb-4 ml-4 flex items-center">
                <div class="flex flex-col">
                    <input
                        id="keyword"
                        placeholder="search everywhere..."
                        v-model="localKeyword"
                        type="text"
                        class="border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                    <label for="keyword" class="text-gray-700 text-sm font-bold mt-1">Keyword</label>
                </div>
            </div>
            <div class="mb-4 ml-4 flex items-center">
                <div class="flex flex-col">
                    <input
                        id="ingredient"
                        placeholder="search ingredients..."
                        v-model="localIngredient"
                        type="text"
                        class="border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    />
                    <label for="ingredient" class="text-gray-700 text-sm font-bold mt-1">Ingredient</label>
                </div>
            </div>
            <div class="mb-4 ml-4 flex">
                <div class="flex flex-col">
                    <button class="p-1 rounded shadow-md" @click=clearFilters>
                        Clear Filters
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
