<?php
use Akaunting\Money\Money;
?>
<div>
    <div class="bg-white overflow-hidden shadow-sm rounded-lg border-b border-gray-200 mt-6">
        <table class="table table-auto w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th scope="col" class="px-4 py-3 font-semibold text-xl text-left" colspan="3">Past Sales</th>
                </tr>
                <tr class="bg-gray-200">
                    <th scope="col" class="t-head">Bean Type</th>
                    <th scope="col" class="t-head">Quantity</th>
                    <th scope="col" class="t-head">Unit Cost</th>
                    <th scope="col" class="t-head">Selling Price</th>
                    <th scope="col" class="t-head">Sold At</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 ">
                @foreach($sales as $sale)
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2">{{ $sale->product->name }}</td>
                    <td class="px-4 py-2">{{ $sale->quantity }}</td>
                    <td class="px-4 py-2">{{ Money::GBP($sale->unit_cost, true) }}</td>
                    <td class="px-4 py-2">{{ Money::GBP($sale->sale_price, true) }}</td>
                    <td class="px-4 py-2">{{ $sale->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-4 py-2 border-t">
            {{ $sales->links() }}
        </div>
    </div>
</div>
