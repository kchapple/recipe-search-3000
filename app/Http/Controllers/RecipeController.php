<?php

namespace App\Http\Controllers;

use App\Http\Resources\RecipeCollection;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $authorEmail = $request->input('author_email');
        $keyword = $request->input('keyword');
        $ingredient = $request->input('ingredient');

        $recipes = Recipe::query();

        if ($authorEmail) {
            $recipes->where('author_email', $authorEmail);
        }

        if ($keyword) {
            $recipes->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%')
                    ->orWhereHas('ingredients', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'like', '%' . $keyword . '%');
                    })
                    ->orWhereHas('steps', function ($subQuery) use ($keyword) {
                        $subQuery->where('description', 'like', '%' . $keyword . '%');
                    });
            });
        }

        if ($ingredient) {
            $recipes->whereHas('ingredients', function ($query) use ($ingredient) {
                $query->where('name', 'like', '%' . $ingredient . '%');
            });
        }

        $recipes = $recipes->paginate($perPage);

        return new RecipeCollection($recipes);
    }

    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe, true, true);
    }
}
