<div>
    <div class="flex flex-col gap-8 items-start">
        <section class="flex flex-col gap-2 w-full">
            <flux:heading size="xl">{{ $library->name }}</flux:heading>
            <flux:text>{{ __('app.library.show_description') }}</flux:text>
        </section>

        <section class="flex flex-col gap-2 w-full">
            <flux:heading>{{ __('app.library.stats') }}</flux:heading>

            <div class="flex flex-row flex-wrap space-x-4 space-y-2 text-sm">
                <flux:badge variant="pill" icon="book-open-text" size="sm">
                    {{ $library->books()->count() }} {{ strtolower(trans_choice('app.book.book', $library->books()->count())) }}
                </flux:badge>
            </div>
        </section>

        <section class="flex flex-col gap-2 w-full">
            <flux:heading>{{ trans_choice('app.book.book', 2) }}</flux:heading>

            <div class="flex flex-row flex-wrap items-stretch gap-4 justify-start">
                @can('create', \App\Models\Book::class)
                    <livewire:app.book-create :initiator="get_class($this)" />
                @endcan

                @foreach ($library->books as $book)
                    <x-books.book-card :book="$book" wire:key="{{ $book->id }}">
                        <flux:button class="w-full mt-3" :href="route('books.show', $book)" wire:navigate>
                            {{ __('actions.view') }}
                        </flux:button>
                    </x-books.book-card>
                @endforeach
            </div>
        </section>
    </div>
</div>
