<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">

            <div class="flex flex-row gap-2 flex-wrap">
                <div>
                    <label class="form-label" for="quantity">
                        Quantity
                    </label>
                    <input type="text" id="quantity" name="quantity" class="form-input rounded-lg p-2 text-sm border-gray-200 shadow-sm focus:border-java-bean-700 focus:ring-0" />
                </div>
                <div class="flex flex-col">
                    <label class="form-label" aria-hidden="true">
                        &nbsp
                    </label>
                    <div class="flex items-center flex-grow font-bold">x</div>
                </div>
                <div>
                    <label class="form-label" for="unit_cost">
                        Unit Cost (£)
                    </label>
                    <input type="text" id="unit_cost" name="unit_cost" class="form-input rounded-lg p-2 text-sm border-gray-200 shadow-sm focus:border-java-bean-700 focus:ring-0" />
                </div>
                <div class="flex flex-col">
                    <label class="form-label" aria-hidden="true">
                        &nbsp
                    </label>
                    <div class="flex items-center flex-grow font-bold">=</div>
                </div>
                <div>
                    <label class="form-label" for="selling_price">
                        Selling Price
                    </label>
                    <input type="text" id="selling_price" name="selling_price" class="form-input bg-gray-100 rounded-lg p-2 text-sm border-gray-200 shadow-sm focus:border-java-bean-700 focus:ring-0" disabled value="£20.00" />
                    <div class="flex justify-center items-center flex-grow"></div>
                </div>
                <div class="flex flex-col justify-end">
                    <button class="bg-java-bean-700 hover:bg-java-bean-800 active:bg-java-bean-800 transition-all text-white px-4 text-sm py-2 shadow-sm rounded-lg md:ml-2">Record Sale 🚀</button>
                </div>
            </div>


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
