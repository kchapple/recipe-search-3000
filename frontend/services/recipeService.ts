import { BASE_URL } from "../stores/constants";

export const fetchRecipeBySlug = async (slug: string) => {
    try {
        const apiUrl = `${BASE_URL}/api/recipes/${slug}`;
        const response = await fetch(apiUrl);

        if (!response.ok) {
            throw new Error(`Error fetching recipe for slug ${slug}`);
        }

        const recipe = await response.json();
        return recipe.data;
    } catch (error) {
        console.error('Error fetching recipe:', error);
        throw error;
    }
};
