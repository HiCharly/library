<div>
    <div class="text-center">
        <flux:modal.trigger name="revoke-share-{{ $user->id }}">
            <flux:link class="cursor-pointer">{{ __('app.library.revoke_share') }}</flux:link>
        </flux:modal.trigger>
    </div>

    <flux:modal name="revoke-share-{{ $user->id }}" class="min-w-[22rem]">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('app.library.revoke_share') }}</flux:heading>
                <flux:text class="mt-2">
                    {{ __('app.library.revoke_share_confirmation', ['name' => $user->name]) }}
                </flux:text>
            </div>

            <div class="flex items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <flux:avatar :name="$user->name" size="sm" />
                <div>
                    <div class="font-medium">{{ $user->name }}</div>
                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        {{ $user->email }}
                    </div>
                </div>
            </div>

            <div class="flex gap-2">
                <flux:modal.close>
                    <flux:button class="w-full">{{ __('actions.cancel') }}</flux:button>
                </flux:modal.close>
                <flux:button 
                    class="w-full"
                    type="button" 
                    variant="danger" 
                    wire:click="revokeAccess"
                >
                    {{ __('app.library.revoke_share') }}
                </flux:button>
            </div>
        </div>
    </flux:modal>
</div>
