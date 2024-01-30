<?php

namespace Tests\Feature;

use App\Models\Recipe;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RecipeControllerTest extends TestCase
{
    use DatabaseTransactions;

    public function testIndexReturnsPaginatedJsonResponse()
    {
        Recipe::factory(15)->create();

        $response = $this->get('/api/recipes');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'author_email',
                ],
            ],
            'meta' => [
                'pagination' => [
                    'total',
                    'per_page',
                    'current_page',
                    'last_page',
                    'from',
                    'to',
                ],
            ],
        ]);
    }
}
