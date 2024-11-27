<x-filament-panels::page>
    <form wire:submit="create">
        {{ $this->form }}

        <button type="submit"
                class="mt-2 filament-button inline-flex items-center justify-center py-1 gap-1 font-medium rounded-lg border transition-colors focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset min-h-[2.25rem] px-4 text-sm text-white shadow focus:ring-white border-transparent bg-primary-600 hover:bg-primary-500 focus:bg-primary-700 focus:ring-offset-primary-700 filament-page-button-action">
            Сохранить
        </button>
    </form>
    @if(auth()->user()->role_id == \App\Models\User::Student)
        {{ $this->productInfolist }}
        {{ $this->table }}
    @endif

</x-filament-panels::page>
