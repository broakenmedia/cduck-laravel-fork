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
            'sales' => $this->getFilteredSales(),
            'products' => Product::select(['id', 'name'])->get(),
            'agents' => User::select(['id', 'name'])->get(),
        ]);
    }

    protected function getFilteredSales()
    {
        $query = Sale::query();
        $filters = [
            'product_id' => $this->productType,
            'sales_agent_id' => $this->agent,
        ];
        foreach ($filters as $column => $value) {
            if ($value !== null) {
                $query->where($column, $value);
            }
        }

        return $query->paginate(config('psyduck.default_items_per_page'));
    }

    public function resetFilters()
    {
        $this->reset(['productType', 'agent']);
    }
}
