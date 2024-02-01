<?php

namespace App\Livewire;

use Akaunting\Money\Money;
use Illuminate\View\View;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class SalesForm extends Component
{
    #[Validate('required|numeric')]
    public ?int $quantity = null;

    #[Validate('required')]
    public ?string $unitCost = null;

    public function render(): View
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

    public function save(): void
    {
        $this->validate();
        //TODO - Database entry
        $this->dispatch('sales-updated');
        $this->reset();
    }
}
