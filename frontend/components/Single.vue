<script setup lang="ts">
import {Recipe} from "../models/api";

interface Props {
    recipe: Recipe
}
const props = defineProps<Props>();

const recipe = ref(props.recipe);

const steps = computed(() => {
    return recipe.value.steps.sort((a, b) => a - b)
})

</script>

<template>
    <div>
        <div class="mb-8">
            <div class="bg-white rounded-lg overflow-hidden shadow-md p-6">
                <h2 class="text-2xl font-bold mb-1">
                    {{ recipe.name }}
                    <span class="text-sm text-gray-400">#{{ recipe.id }}</span>
                </h2>
                <span class="text-gray-400 mr-2">Author Email</span>
                <p class="mb-2">{{ recipe.author_email }}</p>
                <span class="text-gray-400 mr-2">Description</span>
                <p class="mb-2">{{ recipe.description }}</p>
            </div>
        </div>

        <!-- Ingredients Card -->
        <div class="mb-8">
            <div class="bg-white rounded-lg overflow-hidden shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">Ingredients</h2>
                <ul>
                    <li v-for="ingredient in recipe.ingredients" :key="ingredient.id">
                        {{ ingredient.pivot.quantity}} {{ ingredient.name }}
                    </li>
                </ul>
            </div>
        </div>

        <!-- Steps Card -->
        <div>
            <div class="bg-white rounded-lg overflow-hidden shadow-md p-6">
                <h2 class="text-2xl font-bold mb-4">Steps</h2>
                <ol>
                    <li v-for="step in steps" :key="step.id">
                        Step {{ step.order }}: {{ step.description }}
                    </li>
                </ol>
            </div>
        </div>
    </div>
</template>
