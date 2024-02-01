export interface RecipeResponse {
    data: Recipe[]
    meta: PaginationMeta | null;
    links: PaginationLinks | null;
}

export interface Recipe {
    name: string;
    author_email: string;
    slug: string;
}

export interface PaginationMeta {
    total: number;
    per_page?: number;
    current_page?: number;
    last_page?: number;
    from?: number;
    to?: number;
    links?: [];
}

export interface PaginationLinks {
    first: string;
    last: string;
    prev: string;
    next: string;
}
