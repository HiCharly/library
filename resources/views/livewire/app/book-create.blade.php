@use('App\Enums\BookCreateMode')

<div class="w-full">
    <flux:modal.trigger name="create-book" class="block">
        <flux:button class="h-full w-full flex flex-col items-center justify-center gap-2 p-4 border-dashed">
            <flux:icon.plus />
            <span>{{ __('app.book.create_button') }}</span>
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="create-book" class="w-full h-full m-0" x-on:close="selectMode(null)" x-data="{
        controls: undefined,

        async selectMode(mode) {
            await $wire.selectMode(mode);

            // Manage video stream for scanning
            if (mode === '{{ BookCreateMode::SCAN->value }}') {
                this.controls = await window.bookScan();
            }
            else {
                this.controls?.stop();
                this.controls = undefined;
            }
        },
    }">
        @if(is_null($mode))
            <flux:heading class="mb-8" size="xl">{{ __('app.book.create_title') }}</flux:heading>

            <div class="flex flex-col gap-4">
                @foreach(BookCreateMode::cases() as $mode)
                    <flux:button class="w-full h-20" x-on:click="selectMode('{{ $mode->value }}')" wire:key="{{ $mode->value }}">
                        {{ $mode->label() }}
                    </flux:button>
                @endforeach
            </div>
        @else
            <flux:heading class="mb-2" size="xl">{{ $mode->label() }}</flux:heading>
            <flux:heading class="mb-8 flex flex-row gap-2 items-center cursor-pointer text-gray-500 hover:text-gray-700 transition" size="lg" x-on:click="selectMode(null)">
                <flux:icon.arrow-left class="size-5"/>
                {{ __('actions.back') }}
            </flux:heading>

            @if($mode === BookCreateMode::SCAN)
                <video id="video" class="border border-gray-200 w-full h-[auto] rounded-xl"></video>
            @elseif($mode === BookCreateMode::SEARCH)
                <form class="flex flex-col xl:flex-row items-center gap-2 mb-8" wire:submit="submitSearch">
                    <flux:input x-ref="searchTermInput" wire:model="searchTerm" placeholder="{{ __('app.book.search_placeholder') }}" class="flex-1" />
                    <flux:button type="submit" variant="primary" class="w-full xl:w-auto">
                        {{ __('actions.search') }}
                    </flux:button>
                </form>

                @if(!empty($searchTerm))
                    <div class="flex flex-col gap-4">
                        <div class="flex flex-row gap-2">
                            <flux:heading size="lg">{{ __('app.book.results') }}</flux:heading>
                            <flux:badge color="zinc">{{ $searchResults?->count() }}</flux:badge>
                        </div>

                        <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                            @forelse($searchResults as $i => $book)
                                <x-books.book-card :book="$book" wire:key="search_result_{{ $i }}" wire:click="importBook({{ $i }})">
                                    <flux:button class="w-full mt-3" wire:click="importBook({{ $i }})">
                                        {{ __('app.book.import_book') }}
                                    </flux:button>
                                </x-books.book-card>
                            @empty
                                <flux:text class="text-gray-500">{{ __('app.book.no_results') }}</flux:text>
                            @endforelse
                        </div>
                    </div>
                @endif
            @elseif($mode === BookCreateMode::MANUAL)
                <form wire:submit="store" class="space-y-6">
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
            @endif
        @endif
    </flux:modal>
</div>

@push('scripts')
    @vite(['resources/js/book_scan.js'])
@endpush
