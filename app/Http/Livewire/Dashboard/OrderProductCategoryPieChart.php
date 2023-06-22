<?php

namespace App\Http\Livewire\Dashboard;

use Livewire\Component;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class OrderProductCategoryPieChart extends Component
{
    public function render()
    {
        return view('livewire.dashboard.order-product-category-pie-chart');
    }
}
