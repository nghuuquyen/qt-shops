<div class="grid grid-cols-2 gap-4 col-span-2 h-fit">
    <div class="p-4 bg-surface-800 flex flex-col rounded items-center justify-center h-24">
        <span class="font-normal text-base text-on-surface-500 mb-2 w-full">
            Orders
        </span>
        <span wire:loading.remove class="font-bold text-xl text-on-surface-100 w-full">
            {{ $total_orders }}
        </span>
    </div>
    <div class="p-4 bg-surface-800 flex flex-col rounded items-center justify-center h-24">
        <span class="font-normal text-base text-on-surface-500 mb-2 w-full">
            Revenues
        </span>
        <span class="font-bold text-xl text-on-surface-100 w-full">
            {{ $total_revenues }}
        </span>
    </div>
    <div class="p-4 bg-surface-800 flex flex-col rounded items-center justify-center h-24">
        <span class="font-normal text-base text-on-surface-500 mb-2 w-full">
            Customers
        </span>
        <span class="font-bold text-xl text-on-surface-100 w-full">
            {{ $total_customers }}
        </span>
    </div>
    <div class="p-4 bg-surface-800 flex flex-col rounded items-center justify-center h-24">
        <span class="font-normal text-base text-on-surface-500 mb-2 w-full">Average
            Spend
        </span>
        <span class="font-bold text-xl text-on-surface-100 w-full">
            {{ $average_spend }}
        </span>
    </div>
</div>
