<div>
    <flux:heading size="lg">{{ $book->title }}</flux:heading>

    <div class="lg:flex flex-row items-start align-top gap-4 mt-4">
        @if($book->thumbnail_url)
            <img src="{{ $book->thumbnail_url }}" class="w-full md:w-1/3 mb-4    h-auto object-contain">
        @endif

        <div class="space-y-2">
            <flux:text>
                <u>{{ __('app.book.author') }}:</u> {{ $book->author }}
            </flux:text>
            <flux:text>
                <u>{{ __('app.book.publisher') }}:</u> {{ $book->publisher }}
            </flux:text>
            <flux:text>
                <u>{{ __('app.book.published_at') }}:</u> {{ $book->published_at?->format('d/m/Y') }}
            </flux:text>
            <flux:text>
                <u>{{ __('app.book.page_count') }}:</u> {{ $book->page_count }}
            </flux:text>
            <flux:text>
                <u>{{ __('app.book.isbn') }}:</u> {{ $book->isbn }}
            </flux:text>

            <flux:text>
                <u>{{ __('app.book.description') }}:</u> {{ $book->description }}
            </flux:text>
        </div>
    </div>
</div>
