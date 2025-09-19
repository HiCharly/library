<div>
    <div class="flex flex-col gap-6 items-start">
        <flux:heading size="xl">{{ $library->name }}</flux:heading>

        <section class="flex flex-col gap-2 w-full">
            <flux:heading>{{ __('app.library.stats') }}</flux:heading>

            <div class="flex flex-row flex-wrap gap-2">
                <flux:badge variant="pill" icon="book-open-text" size="sm">
                    {{ $library->books()->count() }} {{ strtolower(trans_choice('app.book.book', $library->books()->count())) }}
                </flux:badge>
            </div>
        </section>

        <section class="flex flex-col gap-2 w-full">
            <flux:heading>{{ __('app.library.shares') }}</flux:heading>

            <div class="flex flex-row flex-wrap gap-2">
                @foreach($library->sharedUsers as $user)
                    <flux:badge variant="pill" :icon="$user->pivot->role->icon()" size="sm">
                        {{ $user->name }}
                    </flux:badge>
                @endforeach
            </div>
        </section>

        <section class="flex flex-col gap-4 w-full">
            <div class="flex flex-row items-center justify-between">
                <flux:heading>{{ trans_choice('app.book.book', 2) }}</flux:heading>

                @can('create', \App\Models\Book::class)
                    <livewire:app.book-create :initiator="get_class($this)" />
                @endcan
            </div>

            @if(!$this->search && $this->books->isEmpty())
                <x-empty-state
                    icon="book-open"
                    title="Votre bibliothèque est vide"
                    description="Ajoutez vos premiers livres pour commencer à gérer votre collection."
                />
            @else
                <x-search-bar wire:model.live.debounce="search" :placeholder="__('app.book.search_placeholder')"/>

                <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
                    @forelse ($this->books as $book)
                        <x-books.book-card :book="$book" wire:key="{{ $book->id }}">
                            <flux:button class="w-full mt-3" :href="route('books.show', $book)" wire:navigate>
                                {{ __('actions.view') }}
                            </flux:button>
                        </x-books.book-card>
                    @empty
                        <x-empty-state
                            icon="magnifying-glass"
                            title="Aucun résultat trouvé"
                            description="Aucun livre ne correspond à votre recherche."
                        >
                            <flux:button class="mt-6" wire:click="$set('search', '')">
                                {{  __('actions.clear_search') }}
                            </flux:button>
                        </x-empty-state>
                    @endforelse
                </div>
            @endif
        </section>
    </div>
</div>
