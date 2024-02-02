<?php

namespace App\Livewire;

use Akaunting\Money\Money;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SalesForm extends Component
{
    #[Validate('required|numeric|gt:0')]
    public ?string $quantity = null;

    #[Validate('required|numeric|gt:0')]
    public ?string $unitCost = null;

    #[Validate('required|exists:products,id')]
    public ?int $selectedProductId = null;

    #[Locked]
    public Collection $products;

    public function mount(): void
    {
        $this->products = Product::all();
        $this->selectedProductId = $this->products->first()->id;
    }

    public function render(): View
    {
        return view('livewire.sales-form');
    }

    #[Computed]
    public function selectedProduct(): ?Product
    {
        if ($this->selectedProductId !== null) {
            return Product::find($this->selectedProductId);
        }

        return null;
    }

    #[Computed]
    public function sellingPrice(): ?Money
    {
        if ($this->quantity && $this->unitCost) {
            return Money::GBP($this->calculateSalePrice(), true);
        }

        return null;
    }

    private function calculateSalePrice(): float
    {
        $cost = $this->quantity * $this->unitCost;
        $price = ($cost / (1 - $this->selectedProduct()?->profit_margin ?? 0.00)) + config('psyduck.shipping.countries.UK');

        return $price;
    }

    public function save(): void
    {
        $validated = $this->validate();
        Sale::create([
            'product_id' => $validated['selectedProductId'],
            'quantity' => $validated['quantity'],
            'unit_cost' => $validated['unitCost'],
            'sale_price' => Money::GBP($this->calculateSalePrice(), true)->getValue(),
            'sales_agent_id' => auth()->user()->id,
        ]);
        $this->dispatch('sales.updated');
        $this->reset(['quantity', 'unitCost']);
    }
}
