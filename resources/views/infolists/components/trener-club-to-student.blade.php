<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        {{ $getRecord()?->trener?->club }}
    </div>
</x-dynamic-component>
