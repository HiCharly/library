@props(['form', 'book' => null])

<div class="space-y-6">
    <div class="flex flex-col gap-2">
        <flux:label>{{ __('app.book.thumbnail') }}</flux:label>

        <div class="h-[300px] w-[200px] rounded-lg overflow-hidden">
            @if($form->thumbnail_url)
                <img src="{{ $form->thumbnail_url }}" class="size-full object-cover" />
            @else
                <div
                    class="relative size-full bg-neutral-100 rounded-lg flex items-center justify-center cursor-pointer text-neutral-400 hover:text-neutral-600 hover:bg-neutral-200"
                    x-on:click="$refs.coverInput.click()"
                    x-data="{ uploading: false }"
                    x-on:livewire-upload-start="uploading = true"
                    x-on:livewire-upload-finish="uploading = false"
                    x-on:livewire-upload-cancel="uploading = false"
                    x-on:livewire-upload-error="uploading = false"
                >
                    @php($imageUrl = $form->cover?->temporaryUrl() ?? $book?->getCoverUrl())
                    @if($imageUrl)
                        <img
                            src="{{ $imageUrl }}"
                            class="object-cover size-full"
                            x-show="!uploading"
                        />

                        <div class="absolute inset-0 bg-white/20"></div>

                        <div class="absolute bottom-2 left-1/2 -translate-x-1/2">
                            <flux:button
                                size="sm"
                                x-on:click.stop="$refs.coverInput.click()"
                            >
                                {{ __('actions.edit') }}
                            </flux:button>
                        </div>
                    @else
                        <flux:icon.camera class="size-10" x-show="!uploading" />
                    @endif
                    <flux:icon.loading class="size-10" x-show="uploading" />
                    <input
                        x-ref="coverInput"
                        type="file"
                        class="hidden"
                        wire:model="form.cover"
                        accept="image/png, image/jpeg, image/jpg"
                    />
                </div>
            @endif
        </div>

        <flux:error name="cover" />
    </div>

    <flux:input :label="__('app.book.title')" :placeholder="__('app.book.title')" wire:model="form.title" required />
    <flux:textarea :label="__('app.book.description')" :placeholder="__('app.book.description')" wire:model="form.description" />
    <flux:input :label="__('app.book.isbn')" :placeholder="__('app.book.isbn')" wire:model="form.isbn" />
    <flux:input :label="__('app.book.author')" :placeholder="__('app.book.author')" wire:model="form.author" />
    <flux:input :label="__('app.book.publisher')" :placeholder="__('app.book.publisher')" wire:model="form.publisher" />
    <flux:input :label="__('app.book.published_at')" type="date" wire:model="form.published_at" />
    <flux:input type="hidden" wire:model="form.thumbnail_url"/>
    <flux:input :label="__('app.book.page_count')" type="number" wire:model="form.page_count" min="0"/>
    <flux:input type="hidden" wire:model="form.web_reader_url"/>
</div>
