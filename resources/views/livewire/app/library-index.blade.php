<div>
    <flux:heading size="lg">{{ trans_choice('app.library.library', 2) }}</flux:heading>
    <flux:text class="mt-2">{{ __('app.library.index_description') }}</flux:text>

    <div class="flex flex-row flex-wrap items-stretch gap-4 justify-start mt-4">
        @foreach ($this->libraries as $library)
            <div class="rounded-lg overflow-hidden border border-neutral-200/60 bg-white text-neutral-700 shadow-sm w-full lg:w-[380px]">
                <div class="relative h-60 flex items-center justify-center bg-neutral-100">
                    <flux:icon.wallet class="size-25" />
                </div>
                <div class="p-7">
                    <flux:heading>{{ $library->name }}</flux:heading>
                    <flux:text>This card element can be used to display a product, post, or any other type of data.</flux:text>
                    <flux:button class="w-full mt-5">{{ __('actions.view') }}</flux:button>
                </div>
            </div>
        @endforeach

        <flux:modal.trigger name="create-library">
            <div class="w-full lg:w-[380px] flex flex-col items-center justify-center gap-2 p-4 border-dashed shadow-sm rounded-lg cursor-pointer transition hover:bg-accent-50 bg-white hover:bg-zinc-50 dark:bg-zinc-700 dark:hover:bg-zinc-600/75 text-zinc-800 dark:text-white border border-zinc-200 hover:border-zinc-200 border-b-zinc-300/80 dark:border-zinc-600 dark:hover:border-zinc-600 active:scale-95">
                <flux:icon.plus />
                <span>{{ __('app.library.create_button') }}</span>
            </div>
        </flux:modal.trigger>
    </div>

    <flux:modal name="create-library" class="md:w-96">
        <form wire:submit="store" class="space-y-6">
            <flux:heading size="lg">{{ __('app.library.create_title') }}</flux:heading>
            <flux:input :label="__('app.library.name')" :placeholder="__('app.library.name')" wire:model="form.name" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary">{{ __('actions.create') }}</flux:button>
            </div>
        </form>
    </flux:modal>
</div>
