<div>
    <div class="flex flex-col gap-8 items-start">
        <section class="flex flex-col gap-2 w-full">
            <flux:heading size="lg">{{ $library->name }}</flux:heading>
            <flux:text>{{ __('app.library.show_description') }}</flux:text>
        </section>

        <section class="flex flex-col gap-2 w-full">
            <flux:heading>Statistiques</flux:heading>
            
            <div class="flex flex-row flex-wrap space-x-4 space-y-2 text-sm">
                <flux:badge variant="pill" icon="book-open-text" size="sm">
                    {{ $library->books()->count() }} {{ strtolower(trans_choice('app.book.book', $library->books()->count())) }}
                </flux:badge>
            </div>
        </section>

        <section class="flex flex-col gap-2 w-full">
            <flux:heading>{{ trans_choice('app.book.book', 2) }}</flux:heading>
            <div class="flex flex-row flex-wrap items-stretch gap-4 justify-start">
                @foreach ($library->books as $book)
                    <livewire:app.book-card :book="$book" />
                @endforeach
            </div>
        </section>
    </div>
</div>
