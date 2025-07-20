    @use('App\Models\Library')
    
    <div>
        <flux:heading size="lg">{{ trans_choice('app.library.library', 2) }}</flux:heading>
        <flux:text class="mt-2">{{ __('app.library.index_description') }}</flux:text>

        <div class="flex flex-row flex-wrap items-stretch gap-4 justify-start mt-4">
            @foreach ($this->libraries as $library)
                <div
                    class="rounded-lg overflow-hidden relative border border-neutral-200/60 bg-white text-neutral-700 shadow-sm w-full lg:w-[380px]">
                    <div class="h-60 flex items-center justify-center bg-neutral-100">
                        <flux:icon.wallet class="size-25" />
                    </div>
                    <div class="p-7">
                        <flux:heading>{{ $library->name }}</flux:heading>
                        <flux:text>
                            This card element can be used to display a product, post, or any other type of data.
                        </flux:text>
                        <flux:button class="w-full mt-5" :href="route('libraries.show', $library->id)">
                            {{ __('actions.view') }}
                        </flux:button>
                    </div>

                    <flux:icon.trash
                        class="absolute top-4 right-4 text-red-200 hover:text-red-500 transition cursor-pointer"
                        wire:click="delete({{ $library->id }})" wire:loading.attr="disabled"
                        wire:confirm="{{ __('app.library.delete_confirmation') }}" />
                </div>
            @endforeach

            @can('create', Library::class)
                <div class="w-full lg:w-[380px]">
                    <flux:modal.trigger name="create-library" class="block">
                        <flux:button class="h-full w-full flex flex-col items-center justify-center gap-2 p-4 border-dashed cursor-pointer">
                            <flux:icon.plus />
                            <span>{{ __('app.library.create_button') }}</span>
                        </flux:button>
                    </flux:modal.trigger>
                </div>
                <flux:modal name="create-library" class="md:w-96">
                    <form wire:submit="store" class="space-y-6">
                        <flux:heading size="lg">{{ __('app.library.create_title') }}</flux:heading>
                        <flux:input :label="__('app.library.name')" :placeholder="__('app.library.name')"
                            wire:model="form.name" />
                        <div class="flex">
                            <flux:spacer />
                            <flux:button type="submit" variant="primary">{{ __('actions.create') }}</flux:button>
                        </div>
                    </form>
                </flux:modal>
            @endcan
        </div>
    </div>
</div>