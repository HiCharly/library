<div>
    <flux:modal.trigger name="manage-shares">
        <flux:button 
            variant="outline" 
            size="xs" 
            icon="cog-6-tooth"
        >
            {{ __('app.library.manage_shares') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="manage-shares">
        <flux:heading size="lg">{{ __('app.library.manage_shares') }}</flux:heading>

        <div class="mt-6">
            <flux:heading size="sm" class="mb-4">{{ __('app.library.shares') }}</flux:heading>
            
            <div class="space-y-3">
                @foreach($library->sharedUsers as $user)
                    <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                        <div class="flex items-center gap-3">
                            <flux:avatar :name="$user->name" size="sm" />
                            <div>
                                <div class="font-medium">{{ $user->name }}</div>
                                <div class="text-sm text-gray-500 dark:text-gray-400">
                                    {{ $user->email }}
                                </div>
                            </div>
                        </div>
                        <flux:badge 
                            size="sm"
                        >
                            {{ $user->pivot->role->label() }}
                        </flux:badge>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex justify-end gap-3 mt-6">
            <flux:modal.close>
                <flux:button variant="outline">
                    {{ __('actions.close') }}
                </flux:button>
            </flux:modal.close>
        </div>
    </flux:modal>
</div>
