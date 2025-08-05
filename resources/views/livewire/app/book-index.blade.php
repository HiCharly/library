@use('App\Models\Book')

<div>
    <flux:heading size="xl">{{ trans_choice('app.book.book', 2) }}</flux:heading>
    <flux:text class="mt-2">{{ __('app.book.index_description') }}</flux:text>

    <div class="flex flex-row flex-wrap items-stretch gap-4 justify-start mt-4">
        @foreach ($this->books as $book)
            <x-books.book-card :book="$book" wire:key="{{ $book->id }}">
                <flux:button class="w-full mt-3" :href="route('books.show', $book)" wire:navigate>
                    {{ __('actions.view') }}
                </flux:button>
            </x-books.book-card>
        @endforeach

        @can('create', Book::class)
            <livewire:app.book-create :initiator="get_class($this)" />
        @endcan
    </div>
</div>
