<?php

namespace Tests\Unit\Controllers;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Call this template method before each test method is run.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->loginAsAministrator();
    }

    public function test_can_render_index_page()
    {
        $products = Product::factory()->count(5)->create();

        $response = $this->get(route('products.index'));

        $response
            ->assertOk()
            ->assertViewIs('products.index');

        foreach ($products as $product) {
            $response
                ->assertSee($product->name)
                ->assertSee($product->display_image_url)
                ->assertSee($product->formatted_price);
        }
    }

    public function test_can_create_an_product()
    {
        $body = [
            'name' => 'Dummy name',
            'description' => 'Dummy description',
            'price' => 20000.0
        ];

        $response = $this->post(route('products.store'), $body);

        $response->assertRedirect();

        $this->assertDatabaseHas('products', $body);
    }

    public function test_can_render_show_page()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', [ 'product' => $product->id ]));

        $response
            ->assertOk()
            ->assertViewIs('products.show')
            ->assertViewHas('product', $product)
            ->assertSee($product->name)
            ->assertSee($product->display_image_url)
            ->assertSee($product->formatted_price);
    }

    public function test_can_render_edit_page()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', [ 'product' => $product->id ]));

        $response
            ->assertViewIs('products.edit')
            ->assertViewHas('product', $product)
            ->assertOk();
    }

    public function test_can_update_an_product()
    {
        $product = Product::factory()->create();

        $body = [
            'name' => 'Updated name',
            'description' => 'Updated description',
            'price' => 20000.0
        ];

        $response = $this->put(route('products.update', [ 'product' => $product->id ]), $body);

        $response->assertRedirectToRoute('products.show', [ 'product' => $product->id ]);

        $product->refresh();

        $this->assertSame($product->name, $body['name']);

        $this->assertSame($product->description, $body['description']);

        $this->assertSame($product->price, $body['price']);
    }

    public function test_should_got_validation_error()
    {
        $product = Product::factory()->create();

        $body = [];

        $response = $this->put(route('products.update', [ 'product' => $product->id ]), $body);

        $response->assertInvalid(['name', 'description', 'price']);
    }

    public function test_can_delete_an_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', [ 'product' => $product->id ]));

        $response->assertRedirectToRoute('products.index');

        $this->assertNull( Product::find($product->id) );
    }
}
