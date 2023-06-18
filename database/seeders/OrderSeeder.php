<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    private $target_products;

    /**
     * Construct
     */
    public function __construct()
    {
        $this->target_products = Product::query()->get();
    }

    /**
     * Get fixed dummy users for seed order
     */
    private function getDummyUsers(int $count): array
    {
        $users = [];

        for ($i = 1; $i <= $count; $i++) {
            $users[] = [
                'full_name' => fake()->name(),
                'phone_number' => fake()->phoneNumber(),
                'email' => fake()->email(),
            ];
        }

        return $users;
    }

    /**
     * Get random number of products from the target list
     */
    private function getRamdomTargetProducts(int $total): array
    {
        return $this->target_products->random($total)
            ->map(function ($product) {
                return ['product_id' => $product->id];
            })
            ->toArray();
    }

    /**
     * Create dummy order for given user
     */
    private function createDummyOrder(mixed $user): Order
    {
        $num_items = random_int(1, 5);

        return Order::factory()
            ->state([
                'cart_id' => Cart::factory()
                    ->has(
                        CartItem::factory()->count($num_items)
                            ->state(new Sequence(
                                ...$this->getRamdomTargetProducts($num_items)
                            )),
                        'items'
                    ),
                ...$user
            ])
            ->create();
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = $this->getDummyUsers(20);

        foreach ($users as $user) {
            $num_order = random_int(1, 10);

            for ($j = 1; $j <= $num_order; $j++) {
                $this->createDummyOrder($user);
            }
        }
    }
}