<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Sale;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SalesHistory extends Component
{
    use WithPagination;

    public ?int $productType = null;

    public ?int $agent = null;

    #[On('sales.updated')]
    public function render()
    {
        return view('livewire.sales-history', [
            'sales' => Sale::when($this->productType !== null, function ($query) {
                return $query->where('product_id', $this->productType);
            })->when($this->agent !== null, function ($query) {
                return $query->where('sales_agent_id', $this->agent);
            })->paginate(10),
            'products' => Product::select(['id', 'name'])->get(),
            'agents' => User::select(['id', 'name'])->get(),
        ]);
    }

    public function resetFilters()
    {
        $this->reset(['productType', 'agent']);
    }
}
