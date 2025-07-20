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
    </div>
</div>
