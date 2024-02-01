<?php

namespace App\Livewire;

use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Component;

class SalesHistory extends Component
{
    public Collection $sales;

    public function mount()
    {
        //TODO - Populate with database collection
        $this->sales = collect([(object)['quantity' => 1, 'unit_cost' => 10.00, 'sale_price' => 20.33]]);
    }

    public function render()
    {
        return view('livewire.sales-history');
    }

    #[On('sales-updated')]
    public function onSalesUpdated()
    {
        $this->sales->push((object)['quantity' => 1, 'unit_cost' => 20.00, 'sale_price' => 40.33]);
    }
}
