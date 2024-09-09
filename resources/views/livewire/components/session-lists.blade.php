<div>
    @if (session()->has('lists'))
        @foreach (session('lists') as $index => $list)
            <div class="third-place-fight-text" style="color: red" wire:click="$dispatch('openEditModal', { id: {{ $index }} })">{{ $list['name'] }}</div>
        @endforeach
    @endif
</div>
