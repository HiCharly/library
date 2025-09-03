@props(['book', 'lines', 'size' => 'default', 'show_more' => true])

<div x-data="{ expanded: false }" x-cloak>
    <flux:text :$size>
        <span
            class="block overflow-hidden text-ellipsis"
            :style="expanded ? '' : 'display: -webkit-box; -webkit-line-clamp: {{ $lines }}; -webkit-box-orient: vertical;'"
        >
            {{ $book->description ?? __('N/A') }}
        </span>
    </flux:text>

    @if($show_more)
        <flux:link
            x-on:click="expanded = !expanded"
            class="block cursor-pointer mt-1 text-sm"
            x-text="expanded ? '{{ __('actions.show_less') }}' : '{{ __('actions.show_more') }}'"
        />
    @endif
</div>
