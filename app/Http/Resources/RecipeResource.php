<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    private bool $withIngredients;
    private bool $withSteps;

    public function __construct($resource, $withIngredients = false, $withSteps = false)
    {
        parent::__construct($resource);
        $this->withIngredients = $withIngredients;
        $this->withSteps = $withSteps;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        $resource = [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'description' => $this->description,
            'author_email' => $this->author_email,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        if ($this->withIngredients) {
            $resource['ingredients'] = $this->ingredients;
        }

        if ($this->withSteps) {
            $resource['steps'] = $this->steps;
        }

        return $resource;
    }
}
