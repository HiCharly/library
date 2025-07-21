@use('App\Models\Book')

<div>
    <flux:heading size="lg">{{ trans_choice('app.book.book', 2) }}</flux:heading>
    <flux:text class="mt-2">{{ __('app.book.index_description') }}</flux:text>

    <div class="flex flex-row flex-wrap items-stretch gap-4 justify-start mt-4">
            @foreach ($this->books as $book)
                <livewire:app.book-card :book="$book" />
            @endforeach

            @can('create', Book::class)
                <div class="w-full md:w-[380px]">
                    <flux:modal.trigger name="create-book" class="block">
                        <flux:button class="h-full w-full flex flex-col items-center justify-center gap-2 p-4 border-dashed cursor-pointer">
                            <flux:icon.plus />
                            <span>{{ __('app.book.create_button') }}</span>
                        </flux:button>
                    </flux:modal.trigger>
                </div>
                <flux:modal name="create-book" class="w-full">
                    <form wire:submit="store" class="space-y-6">
                        <flux:heading size="lg">{{ __('app.book.create_title') }}</flux:heading>
                        <flux:input :label="__('app.book.title')" :placeholder="__('app.book.title')" wire:model="form.title" required />
                        <flux:textarea :label="__('app.book.description')" :placeholder="__('app.book.description')" wire:model="form.description" />
                        <flux:input :label="__('app.book.isbn')" :placeholder="__('app.book.isbn')" wire:model="form.isbn" />
                        <flux:input :label="__('app.book.author')" :placeholder="__('app.book.author')" wire:model="form.author" />
                        <flux:input :label="__('app.book.publisher')" :placeholder="__('app.book.publisher')" wire:model="form.publisher" />
                        <flux:input :label="__('app.book.published_at')" type="date" wire:model="form.published_at" />
                        <flux:input :label="__('app.book.page_count')" type="number" wire:model="form.page_count" min="0"/>
                        <div class="flex">
                            <flux:spacer />
                            <flux:button type="submit" variant="primary">{{ __('actions.create') }}</flux:button>
                        </div>
                    </form>
                </flux:modal>
            @endcan
        </div>
</div>
