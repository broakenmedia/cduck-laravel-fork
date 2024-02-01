<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('New ☕️ Sales') }}
        </h2>
    </x-slot>

    <div class="py-6 md:py-12 px-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-4">
            <livewire:sales-form></livewire:sales-form>
            <hr class="my-4" />
            <livewire:sales-history></livewire:sales-history>
        </div>
    </div>
</x-app-layout>
