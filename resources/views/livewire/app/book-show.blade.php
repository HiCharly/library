@php use Carbon\Carbon; @endphp
<div>
    <div class="flex flex-col gap-8">
        <flux:heading size="xl">{{ $book->title }}</flux:heading>

        <div class="flex flex-row gap-4">
            <div class="h-[300px] w-[200px] rounded-lg overflow-hidden">
                @if($coverUrl = $book->getCoverUrl())
                    <img src="{{ $coverUrl }}" class="size-full object-cover" />
                @else
                    <x-books.book-cover-placeholder />
                @endif
            </div>
            <div class="flex flex-col gap-2">
                <div class="flex flex-col">
                    <flux:text size="sm">{{ __('app.book.author') }}</flux:text>
                    <flux:text>{{ $book->author ?? 'N/A' }}</flux:text>
                </div>

                <div class="flex flex-col">
                    <flux:text size="sm">{{ __('app.book.publisher') }}</flux:text>
                    <flux:text>{{ $book->publisher ?? 'N/A' }}</flux:text>
                </div>

                <div class="flex flex-col">
                    <flux:text size="sm">{{ __('app.book.published_at') }}</flux:text>
                    <flux:text>{{ $book->published_at ? Carbon::parse($book->published_at)->format('d/m/Y') : '-' }}</flux:text>
                </div>

                <div class="flex flex-col">
                    <flux:text size="sm">{{ __('app.book.isbn') }}</flux:text>
                    <flux:text>{{ $book->isbn ?? 'N/A' }}</flux:text>
                </div>

                <div class="flex flex-col">
                    <flux:text size="sm">{{ __('app.book.page_count') }}</flux:text>
                    <flux:text>{{ $book->page_count ?? 'N/A' }}</flux:text>
                </div>
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <flux:heading>{{ __('app.book.description') }}</flux:heading>
            <x-books.book-description :$book :lines="5"/>
        </div>

        <div class="flex flex-row gap-2">
            <flux:button :href="route('books.edit', $book)">{{ __('actions.edit') }}</flux:button>

            @if($book->web_reader_url)
                <flux:button :href="$book->web_reader_url" target="_blank" rel="noopener" variant="primary">
                    <span class="inline-flex items-center gap-2">
                        {{ __('actions.preview') }}
                        <flux:icon.arrow-top-right-on-square class="size-4" />
                    </span>
                </flux:button>
            @endif
        </div>
    </div>
</div>
