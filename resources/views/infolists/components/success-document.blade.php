<x-dynamic-component :component="$getEntryWrapperView()" :entry="$entry">
    <div>
        <livewire:components.checkbox :record="$getRecord()" :entry="$entry" />
{{--        {{ $getState() }}--}}
    </div>
</x-dynamic-component>
