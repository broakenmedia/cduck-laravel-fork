<?php

namespace App\Livewire;

use Akaunting\Money\Money;
use App\Models\Product;
use App\Models\Sale;
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

    #[Locked]
    public float $profitMargin;

    #[Locked]
    public Product $goldProduct;

    public function mount(): void
    {
        //Pretending for Part 1 we're in a world where they'll only ever sell Gold Beans.
        $this->goldProduct = Product::where('name', 'Gold')->first();
        if ($this->goldProduct !== null) {
            $this->profitMargin = $this->goldProduct->profit_margin;
        }
    }

    public function render(): View
    {
        return view('livewire.sales-form');
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
        $price = $cost / (1 - $this->profitMargin) + config('psyduck.shipping.countries.UK');
        return $price;
    }

    public function save(): void
    {
        $validated = $this->validate();
        Sale::create([
            'product_id' => $this->goldProduct->id,
            'quantity' => $validated['quantity'],
            'unit_cost' => $validated['unitCost'],
            'sale_price' => Money::GBP($this->calculateSalePrice(), true)->getValue(),
        ]);
        $this->dispatch('sales-updated');
        $this->reset(['quantity', 'unitCost']);
    }
}
