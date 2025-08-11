<div>
    <div class="p-4 flex flex-col gap-2 aspect-video rounded-xl border border-neutral-200 dark:border-neutral-700" x-data="{
        controls: undefined,

        async startScan() {
            $flux.modal('book-finder').show();
            $nextTick(async () => {
                this.controls = await window.bookScan();
            });
        },

        async stopScan() {
            this.controls?.stop();
        },
    }" x-on:book-finder-start-scan.window="startScan()" x-on:book-finder-stop-scan.window="stopScan()">
        <flux:heading>{{ __('app.book_finder.title') }}</flux:heading>
        <flux:text>{{ __('app.book_finder.description') }}</flux:text>

        <flux:spacer />

        <div>
            <flux:button class="w-full" x-on:click="startScan()">
                {{ __('app.book_finder.check_book') }}
            </flux:button>
        </div>
    </div>

    <flux:modal name="book-finder" class="flex flex-col" x-on:close="cancel">
        <flux:heading size="lg">{{ __('app.book_finder.title') }}</flux:heading>

        @if(is_null($searchResults))
            <flux:text class="mt-2">{{ __('app.book_finder.description') }}</flux:text>

            <video id="video" class="border border-gray-200 w-full h-[auto] rounded-xl mt-4"></video>
        @elseif($searchResults->isEmpty())
            <flux:callout class="mt-4" variant="warning" icon="exclamation-circle" :heading="__('app.book_finder.no_results')" />
        @else
            <flux:text class="mt-2">{{ __('app.book_finder.found_books') }}</flux:text>

            <div class="mt-4 grid grid-cols-1 xl:grid-cols-2 gap-4">
                @forelse($searchResults as $i => $book)
                    <x-books.book-card :book="$book" wire:key="search_result_{{ $i }}">
                        <flux:button class="w-full mt-3" variant="primary" color="green">
                            {{ __('app.book_finder.found') }}
                        </flux:button>
                    </x-books.book-card>
                @empty
                @endforelse
            </div>
        @endif

        <flux:spacer />

        <div class="flex flex-row gap-4 mt-4">
            <flux:button class="w-full" wire:click="cancel">
                {{ __('actions.quit') }}
            </flux:button>
            @if($searchResults)
                <flux:button class="w-full" wire:click="again">
                    {{ __('app.book_finder.scan_again') }}
                </flux:button>
            @endif
        </div>
    </flux:modal>
</div>

@push('scripts')
    @vite(['resources/js/book_scan.js'])
@endpush

