<script setup lang="ts">
import { ref, onMounted, onErrorCaptured } from 'vue';
import { fetchRecipeBySlug } from '../../services/recipeService';
import { useRouter } from 'vue-router';

const route = useRoute()
console.log(route.params.slug)
const recipe = ref(null);

const router = useRouter();
const goBackToRecipes = () => {
    router.go(-1);
};

onMounted(async () => {
    try {
        recipe.value = await fetchRecipeBySlug(route.params.slug);
    } catch (error) {
        console.error('Error fetching recipe:', error);
    }
});
</script>

<template>
    <div>
        <div v-if="!recipe">
            <div class="fixed top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="border-t-4 border-blue-500 border-solid rounded-full animate-spin h-12 w-12"></div>
            </div>
        </div>
        <div v-else class="container mx-auto p-8">
            <button class="p-2 rounded shadow-md mb-4" @click="goBackToRecipes">
                Back to recipes
            </button>

            <Single :recipe="recipe" />
        </div>
    </div>

</template>
