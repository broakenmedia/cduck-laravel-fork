<?php

namespace App\Livewire;

use App\Models\Sale;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class SalesHistory extends Component
{
    use WithPagination;

    #[On('sales.updated')]
    public function render()
    {
        return view('livewire.sales-history', [
            'sales' => Sale::paginate(10),
        ]);
    }
}
