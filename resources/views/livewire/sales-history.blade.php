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
                    <td class="px-4 py-2 flex items-center gap-1">{{ $sale->created_at }}
                        <div class="group relative flex-row inline-flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#db0000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-user cursor-pointer w-4 stroke-java-bean-500">
                                <circle cx="12" cy="12" r="10" />
                                <circle cx="12" cy="10" r="3" />
                                <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662" />
                            </svg>
                            <span class="group-hover:opacity-100 transition-opacity bg-java-bean-800 px-2 py-1 text-xs text-gray-100 rounded-md opacity-0 mx-auto">{{ $sale->agent->name }}</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="px-4 py-2 border-t">
            {{ $sales->links() }}
        </div>
    </div>
</div>
