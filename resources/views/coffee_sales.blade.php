<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            <livewire:sales-form></livewire:sales-form>
            <div class="bg-white overflow-hidden shadow-sm rounded-lg border-b border-gray-200 mt-6">
                <table class="table table-auto w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th scope="col" class="px-4 py-3 font-semibold text-xl text-left" colspan="3">Past Sales</th>
                        </tr>
                        <tr>
                            <th scope="col" class="t-head">Quantity</th>
                            <th scope="col" class="t-head">Unit Cost</th>
                            <th scope="col" class="t-head">Selling Price</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 ">
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">£10.00</td>
                            <td class="px-4 py-2">£23.33</td>
                        </tr>
                        <tr class="hover:bg-gray-100">
                            <td class="px-4 py-2">1</td>
                            <td class="px-4 py-2">£10.00</td>
                            <td class="px-4 py-2">£23.33</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
