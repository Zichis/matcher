<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\PropertyType;
use App\Models\SearchProfile;
use Database\Factories\PropertyTypeFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MatchTest extends TestCase
{
    use RefreshDatabase;

    /**
     *
     * @return void
     */
    public function test_match_works_when_data_is_available()
    {
        PropertyType::factory()
            ->has(Property::factory()->count(3))
            ->has(SearchProfile::factory()->count(3))
            ->create();

        $property = Property::first();

        $response = $this->get("api/match/{$property->id}");

        $response->assertStatus(200);

        $response->assertSee('searchProfileId');
        $response->assertSee('score');
        $response->assertSee('strictMatchesCount');
        $response->assertSee('looseMatchesCount');
    }

    /**
     *
     * @return void
     */
    public function test_returns_empty_array_if_no_property_type_matches()
    {
        PropertyType::factory()
            ->has(Property::factory()->count(3))
            ->create();

        $property = Property::first();

        $response = $this->get("api/match/{$property->id}");

        $response->assertStatus(200);
        $response->assertExactJson([]);
    }

    /**
     *
     * @return void
     */
    public function test_match_fails_when_data_is_not_available()
    {
        $response = $this->get('api/match/1');

        $response->assertStatus(404);
    }
}
