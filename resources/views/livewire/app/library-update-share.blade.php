@use('App\Enums\LibraryShareRole')

<div>
    <flux:modal.trigger name="edit-share-{{ $user->id }}">
        <flux:button 
            variant="outline" 
            size="xs" 
            icon="pencil"
            class="whitespace-nowrap"
        >
            {{ __('actions.edit') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="edit-share-{{ $user->id }}">
        <flux:heading size="lg">{{ __('app.library.edit_share') }}</flux:heading>

        <div class="mt-6">
            <div class="mb-4">
                <flux:heading size="sm" class="mb-2">{{ trans_choice('app.user.user', 1) }}</flux:heading>
                <div class="flex items-center gap-3">
                    <flux:avatar :name="$user->name" size="sm" />
                    <div>
                        <div class="font-medium">{{ $user->name }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ $user->email }}
                        </div>
                    </div>
                </div>
            </div>

            <form wire:submit="updateRole" class="space-y-4">
                <flux:field>
                    <flux:label for="role">{{ __('app.library.role') }}</flux:label>
                    <flux:select wire:model="form.role">
                        @foreach(LibraryShareRole::applicableRoles() as $role)
                            <option value="{{ $role->value }}">{{ $role->label() }}</option>
                        @endforeach
                    </flux:select>
                    <flux:error name="form.role" />
                </flux:field>

                <div class="flex gap-3">
                    <flux:modal.close>
                        <flux:button class="w-full">
                            {{ __('actions.cancel') }}
                        </flux:button>
                    </flux:modal.close>
                    <flux:button type="submit" variant="primary" class="w-full">
                        {{ __('actions.edit') }}
                    </flux:button>
                </div>

                <div class="mt-8">
                    <livewire:app.library-revoke-share :library="$library" :user="$user" />
                </div>
            </form>
        </div>
    </flux:modal>
</div>
