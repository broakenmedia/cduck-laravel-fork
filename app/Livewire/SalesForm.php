<?php

namespace App\Livewire;

use Akaunting\Money\Money;
use Livewire\Attributes\Computed;
use Livewire\Component;

class SalesForm extends Component
{
    public ?int $quantity = null;
    public ?string $unitCost = null;

    public function render()
    {
        return view('livewire.sales-form');
    }

    #[Computed]
    public function sellingPrice(): ?Money
    {
        if ($this->quantity && $this->unitCost) {
            $cost = $this->quantity * $this->unitCost;
            $price = $cost / (1 - 0.25) + config('psyduck.shipping.countries.UK');
            return Money::GBP($price, true);
        }
        return null;
    }
}
