<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Scout\Searchable;

class Recipe extends Model
{
    use HasFactory,
        Searchable;

    protected $fillable = ['name', 'author_email'];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'author_email' => $this->author_email,
        ];
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class)->withPivot('quantity');
    }

    public function steps(): HasMany
    {
        return $this->hasMany(Step::class);
    }
}
