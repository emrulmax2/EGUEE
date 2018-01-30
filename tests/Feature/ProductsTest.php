<?php

namespace Tests\Feature;
use App\User;
use App\Products;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ProductsTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testsProductsAreCreatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $payload = [
            'productname' => 'Coca Cola',
            'price' => 29.50,
            'sku' => 'SK2019',
            'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'currency' => 'EUR'
        ];

        $this->json('POST', '/api/products', $payload, $headers)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 
            'productname' => 'Coca Cola',
            'price' => 29.50,
            'sku' => 'SK2019',
            'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'currency' => 'EUR']);
    }

    public function testsProductsAreUpdatedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Products::class)->create([
            'productname' => 'Sprite',
            'price' => 20.50,
            'sku' => 'MK2009',
            'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'currency' => 'EUR'
        ]);

        $payload = [
            'productname' => 'Sprite',
            'price' => 20.50,
            'sku' => 'MK2009',
            'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'currency' => 'EUR'
        ];

        $response = $this->json('PUT', '/api/products/' . $article->id, $payload, $headers)
            ->assertStatus(200)
            ->assertJson([ 
                'id' => 1, 
                'productname' => 'Sprite',
                'price' => 20.50,
                'sku' => 'MK2009',
                'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                'currency' => 'EUR'
            ]);
    }

    public function testsProductsAreDeletedCorrectly()
    {
        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];
        $article = factory(Products::class)->create([
                'productname' => 'Sprite',
                'price' => 20.50,
                'sku' => 'MK2009',
                'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                'currency' => 'EUR'
        ]);

        $this->json('DELETE', '/api/products/' . $article->id, [], $headers)
            ->assertStatus(204);
    }

    public function testProductsAreListedCorrectly()
    {
        factory(Products::class)->create([
            'productname' => 'Coca Cola',
            'price' => 29.50,
            'sku' => 'SK2019',
            'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
            'currency' => 'EUR'
        ]);

        factory(Products::class)->create([
                'productname' => 'Sprite',
                'price' => 20.50,
                'sku' => 'MK2009',
                'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                'currency' => 'EUR'
        ]);

        $user = factory(User::class)->create();
        $token = $user->generateToken();
        $headers = ['Authorization' => "Bearer $token"];

        $response = $this->json('GET', '/api/products', [], $headers)
            ->assertStatus(200)
            ->assertJson([
                [   'productname' => 'Coca Cola',
                    'sku' => 'SK2019',
                    'price' => 29.50,
                    'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                    'currency' => 'EUR' ],
                [   'productname' => 'Sprite',
                    'sku' => 'MK2009',
                    'price' => 20.50,
                    'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                    'currency' => 'EUR' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'productname', 'sku', 'price','description','currency', 'created_at', 'updated_at'],
            ]);
    }
    
}
