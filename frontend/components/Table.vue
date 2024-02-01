<script setup lang="ts">
import { Recipe } from "../models/api";

interface Props {
    recipes: Recipe[],
    loading: boolean
}
const props = defineProps<Props>();

</script>

<template>
    <div>
        <div v-if="props.loading && props.recipes">
            <LoadingIndicator />
        </div>
        <table v-else class="min-w-full border border-gray-300 shadow-md">
            <thead>
            <tr>
                <th class="py-2 px-4 border-b">ID</th>
                <th class="py-2 px-4 border-b">Author</th>
                <th class="py-2 px-4 border-b">Name</th>
                <th class="py-2 px-4 border-b"></th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="recipe in props.recipes" :key="recipe.id">
                <td class="py-2 px-4 border-b">{{ recipe.id }}</td>
                <td class="py-2 px-4 border-b">{{ recipe.author_email }}</td>
                <td class="py-2 px-4 border-b">{{ recipe.name }}</td>
                <td class="py-2 px-4 border-b">
                    <button class="p-1 rounded shadow-md">
                        <nuxt-link
                            :to="`/recipes/${recipe.slug}`"
                        >
                            <span class="text-xs">View Details</span>
                        </nuxt-link>
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
