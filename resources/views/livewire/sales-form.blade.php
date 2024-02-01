<div>
    <form wire:submit="save" class="flex flex-row gap-2 flex-wrap">
        <div>
            <label class="form-label" for="quantity">
                Quantity
                @error('quantity')
                <span class="text-xs text-red-600">- Required</span>
                @enderror
            </label>
            <input type="number" step="1" id="quantity" class="form-input rounded-lg p-2 text-sm border-gray-200 shadow-sm focus:border-java-bean-700 focus:ring-0" wire:model.live="quantity" />
        </div>
        <div>
            <label class="form-label" for="unit_cost">
                Unit Cost (£)
                @error('unitCost')
                <span class="text-xs text-red-600">- Required</span>
                @enderror
            </label>
            <input type="number" step="0.01" id="unit_cost" class="form-input rounded-lg p-2 text-sm border-gray-200 shadow-sm focus:border-java-bean-700 focus:ring-0" wire:model.live="unitCost" />
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
            <input type="text" id="selling_price" class="form-input bg-gray-100 rounded-lg p-2 text-sm border-gray-200 shadow-sm focus:border-java-bean-700 focus:ring-0" disabled value="{{ $this->sellingPrice }}" />
            <div class="flex justify-center items-center flex-grow"></div>
        </div>
        <div class="flex flex-col justify-end">
            <button type="submit" class="bg-java-bean-700 hover:bg-java-bean-800 active:bg-java-bean-800 transition-all text-white px-4 text-sm py-2 shadow-sm rounded-lg md:ml-2">Record Sale 🚀</button>
        </div>
    </form>
</div>
