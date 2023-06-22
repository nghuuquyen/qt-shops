<div {{ $attributes->merge(['class' => 'flex flex-col lg:flex-row items-center p-4 bg-surface relative']) }}>
    <div class="flex items-center">
        <a href="/" class="lg:mr-6">
            <h1>
                <x-application-logo />
            </h1>
        </a>
    </div>

    <div class="grid grid-cols-3 gap-2 mt-6 lg:flex lg:mt-0">

        @can('view dashboard')
            <a class="{{ Route::is(['dashboard']) ? 'text-on-surface-600 font-bold' : 'text-on-surface-500' }} px-6 hover:text-on-surface-600"
                href="{{ route('dashboard') }}">
                Dashboard
            </a>
        @endcan

        @can('viewAny', \App\Models\Product::class)
            <a class="{{ Route::is(['products.index', 'products.show', 'products.edit', 'products.create']) ? 'text-on-surface-600 font-bold' : 'text-on-surface-500' }} px-6 hover:text-on-surface-600"
                href="{{ route('products.index') }}">
                Products
            </a>
        @endcan

        @can('viewAny', \App\Models\Order::class)
            <a class="{{ Route::is(['orders.index', 'orders.show']) ? 'text-on-surface-600 font-bold' : 'text-on-surface-500' }} px-6 hover:text-on-surface-600"
                href="{{ route('orders.index') }}">
                Orders
            </a>
        @endcan

        @can('viewAny customers')
            <a class="{{ Route::is(['customers.index']) ? 'text-on-surface-600 font-bold' : 'text-on-surface-500' }} px-6 hover:text-on-surface-600"
                href="{{ route('customers.index') }}">
                Customers
            </a>
        @endcan

        @can('viewAny', \App\Models\Report::class)
            <a class="{{ Route::is(['reports.index', 'reports.show', 'reports.edit', 'reports.create']) ? 'text-on-surface-600 font-bold' : 'text-on-surface-500' }} px-6 hover:text-on-surface-600"
                href="{{ route('reports.index') }}">
                Reports
            </a>
        @endcan

        @can('viewAny', \App\Models\Role::class)
            <a class="{{ Route::is(['roles.index', 'roles.show', 'roles.edit', 'roles.create']) ? 'text-on-surface-600 font-bold' : 'text-on-surface-500' }} px-6 hover:text-on-surface-600"
                href="{{ route('roles.index') }}">
                Roles
            </a>
        @endcan

        @if ($hasSetting)
            <livewire:setting-dropdown />
        @endif
    </div>
</div>
