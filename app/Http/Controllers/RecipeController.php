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
        $query = $request->input('query');
        if ($query) {
            $recipes = Recipe::search($query)->paginate($perPage);
        } else {
            $recipes = Recipe::paginate($perPage);
        }
        return new RecipeCollection($recipes);
    }

    public function show($id)
    {
        $recipe = Recipe::findOrFail($id);
        return new RecipeResource($recipe);
    }
}
