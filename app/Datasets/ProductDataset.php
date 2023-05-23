<?php

namespace App\Datasets;

class ProductDataset {

    public $categories = [
        [
            'id' => 1,
            'name' => 'Cafe',
        ],
        [
            'id' => 2,
            'name' => 'Chicken',
        ]
    ];

    public $products = [
        [
            'id' => 1,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 2,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 3,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 4,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 5,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 6,
            'category_id' => 1,
            'name' => 'Cappuchino',
            'description' => 'Cappuccino is a coffee drink that today is typically composed of a single espresso shot and hot milk',
            'price' => 35000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 7,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 8,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 9,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 10,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 11,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ],
        [
            'id' => 12,
            'category_id' => 2,
            'name' => 'Chicken satay salad',
            'description' => 'Marinate chicken breasts, then drizzle with a punchy peanut satay sauce',
            'price' => 50000,
            'currency' => 'VNĐ',
            'thumnail_url' => 'https://images.unsplash.com/photo-1509042239860-f550ce710b93?w=150&h=150',
        ]
    ];

    public function getProducts()
    {
        return collec($this->products);
    }

    public function getCategoeis()
    {
        return collect($this->categories);
    }

    public function getProductsByCateogry($category) 
    {
        return collect($this->products)->filter(function($product) use ($category) {
            return $product['category_id'] == $category['id'];
        });
    }
}