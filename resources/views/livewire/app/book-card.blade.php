<div>
    <a href="{{ route('books.show', $book->id) }}" class="cursor-pointer" wire:navigate>
        <div class="rounded-lg overflow-hidden relative border border-neutral-200/60 bg-white text-neutral-700 shadow-sm w-full md:w-[380px]">
            @if($book->thumbnail_url)
                <div class="h-60 w-full bg-cover object-center" style="background-image: url('{{ $book->thumbnail_url }}');"></div>
            @else
                <div class="h-60 flex items-center justify-center bg-neutral-100">
                    <flux:icon.book-open-text class="size-25" />
                </div>
            @endif

            <div class="p-7">
                <flux:heading>{{ $book->title }}</flux:heading>
                <flux:text class="line-clamp-3" title="{{ $book->description }}">
                    {{ $book->description }}
                </flux:text>
                <flux:text size="sm" class="mt-4 flex flex-row flex-wrap space-x-4 space-y-2">
                    <flux:badge variant="pill" icon="users" size="sm" :title="__('app.book.author')">
                        {{ $book->author }}
                    </flux:badge>
                    <flux:badge variant="pill" icon="building-library" size="sm" :title="__('app.book.publisher')">
                        Édition {{ $book->publisher }}
                    </flux:badge>
                </flux:text>
            </div>
        </div>
    </a>
</div>