@props(['book'])

<div class="rounded-lg flex flex-row justify-start items-stretch w-full border border-neutral-200/60 overflow-hidden">
    <div class="h-[300px] w-[200px]">
        @if($coverUrl = $book->getCoverUrl())
            <img src="{{ $coverUrl }}" class="size-full object-cover" />
        @else
            <x-books.book-cover-placeholder />
        @endif
    </div>
    <div class="w-full flex flex-col p-4 gap-2">
        <flux:heading>{{ $book->title }}</flux:heading>

        <x-books.book-description :$book :lines="3" size="sm" :show_more="false"/>

        <div class="flex flex-col items-start gap-1 text-sm">
            <div class="flex flex-row items-center gap-2">
                <flux:icon.users class="size-3" />
                <flux:text class="line-clamp-1" class="text-xs" variant="strong">
                    {{ $book->author }}
                </flux:text>
            </div>
            <div class="flex flex-row items-center gap-2">
                <flux:icon.building-library class="size-3" />
                <flux:text class="line-clamp-1" class="text-xs" variant="strong">
                    {{ $book->publisher }}
                </flux:text>
            </div>
            <div class="flex flex-row items-center gap-2">
                <flux:icon.calendar class="size-3" />
                <flux:text class="line-clamp-1" class="text-xs" variant="strong">
                    {{ $book->published_at?->format('d/m/Y') }}
                </flux:text>
            </div>
        </div>

        <flux:spacer/>

        {{ $slot }}
    </div>
</div>
