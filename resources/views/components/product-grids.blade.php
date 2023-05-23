<div class="px-2 py-2 lg:px-0" id="category_{{ $category['id'] }}">
    <h1 class="text-2xl mb-2">{{ $category['name'] }}</h1>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        @foreach ( $products as $product )
            <x-product-card :product="$product" />
        @endforeach
    </div>
</div>
