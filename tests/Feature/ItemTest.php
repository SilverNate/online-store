<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ItemTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_items()
    {
        $response = $this->getJson('/api/items');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'name',
                    'description',
                    'meta_description',
                    'sku',
                    'quantity',
                    'price',
                    'special_price',
                    'is_enable',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    public function test_item_detail()
    {

        $response = $this->json('GET', '/api/item', [
            'id' => 1,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'name',
                'description',
                'sku',
                'quantity',
                'price',
                'special_price',
                'is_enable',
                'created_at',
                'updated_at',

            ]);
    }
}
