<div>
    @if (session()->has('lists'))
        @foreach (session('lists') as $index => $list)
            <div class="third-place-fight-text" wire:click="$dispatch('openEditModal', { id: {{ $index }} })">{{ $list['name'] }}</div>
        @endforeach
    @endif
</div>
