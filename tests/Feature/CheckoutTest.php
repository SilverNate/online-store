<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CheckoutTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_add_to_cart()
    {
        //get credentials
        $credentials = $this->postJson('/api/login', ['email' => 'andean@gmail.com', 'password' => 'root18kar']);
        $token = $credentials['access_token'];

        //get item
        $getItems = $this->getJson('/api/items');
        $qty = 1;
        $ids = 0;

        foreach ($getItems->json() as $key => $value) {
            $ids  = $value['id'];
            break;
        }

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/api/cart/add', ['id' => $ids, 'quantity' => $qty]);

        $response
            ->assertStatus(200)
            ->assertOk();
    }


    public function test_get_active_cart()
    {

        //get credentials
        $credentials = $this->postJson('/api/login', ['email' => 'andean@gmail.com', 'password' => 'root18kar']);
        $token = $credentials['access_token'];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', '/api/cart');

        $response
            ->assertStatus(200)
            ->assertOk();
    }

    protected function getAllCart()
    {
        //get credentials
        $credentials = $this->postJson('/api/login', ['email' => 'andean@gmail.com', 'password' => 'root18kar']);
        $token = $credentials['access_token'];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', '/api/cart');


        $data = [];
        foreach ($response->json() as $key => $value) {
            if ($key == 'results') {
                $data = $value;
            }
        }

        $cartId = $data[0]['id'];

        $simpans = [
            'cart_id' => $cartId,
            'token' => $token,
        ];

        return $simpans;
    }

    public function test_get_cart_detail()
    {

        $reData = $this->getAllCart();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $reData['token'],
        ])->json('GET', '/api/cart/detail', ['cart_id' => $reData['cart_id']]);

        $response
            ->assertStatus(200)
            ->assertOk();
    }

    public function test_checkout()
    {
        //get credentials
        $credentials = $this->postJson('/api/login', ['email' => 'andean@gmail.com', 'password' => 'root18kar']);
        $token = $credentials['access_token'];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', '/api/checkout');

        $response
            ->assertStatus(200)
            ->assertOk();
    }
}
