<script setup lang="ts">
import { useRouter } from 'vue-router';
const router = useRouter();

const url = ref(`${BASE_URL}/api/recipes`);
const page = ref(1);
const authorEmail = ref('');
const keyword = ref('');
const ingredient = ref('');

// Function to fetch recipes based on the current filter values
const { pending, data: recipeResponse, execute } = await useFetch(url, {
    fetchOnServer: true,
    immediate: false,
    query: {
        page: page,
        author_email: authorEmail,
        keyword: keyword,
        ingredient: ingredient,
    },
});

const recipes = computed(() => recipeResponse.value?.data || []);
const paginationLinks = computed(() => recipeResponse.value?.links || []);
const paginationMeta = computed(() => recipeResponse.value?.meta || []);

const fetchRecipes = async () => {
    execute();
};

const updateFiltersFromQuery = () => {
    const query = router.currentRoute.value.query;
    page.value = query.page;
    authorEmail.value = query.author_email || '';
    keyword.value = query.keyword || '';
    ingredient.value = query.ingredient || '';
};

const onPageChanged = (pageNumber) => {
    page.value = pageNumber;
};

const onFiltersChanged = (filters) => {
    page.value = 1;
    authorEmail.value = filters.authorEmail;
    keyword.value = filters.keyword;
    ingredient.value = filters.ingredient;
}

onBeforeMount(() => {
    fetchRecipes();
    updateFiltersFromQuery();
});

watchEffect(() => {
    const { path, query } = router.currentRoute.value;
    const newQuery = {
        ...query,
        page: page.value || undefined,
        author_email: authorEmail.value || undefined,
        keyword: keyword.value || undefined,
        ingredient: ingredient.value || undefined,
    };
    router.replace({ path, query: newQuery });
});
</script>

<template>
    <div>
        <div class="container mx-auto p-4">
            <Header :title="`Recipe Search 3000`" />
            <Filters :authorEmail="authorEmail" :keyword="keyword" :ingredient="ingredient" @changed="onFiltersChanged"/>
            <Table :loading="pending" :recipes="recipes" />
            <div class="mt-4">
                <pagination :meta="paginationMeta" :links="paginationLinks" @change="onPageChanged" />
            </div>
        </div>
    </div>
</template>
