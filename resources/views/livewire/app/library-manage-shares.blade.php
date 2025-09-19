@use('App\Enums\LibraryShareRole')

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
        <div class="flex flex-col gap-8">
            <flux:heading size="lg">{{ __('app.library.manage_shares') }}</flux:heading>

            {{-- Existing shares list --}}
            <div>
                <flux:heading class="mb-4">{{ __('app.library.shares') }}</flux:heading>
                
                 <div class="space-y-2">
                     @foreach($library->sharedUsers as $user)
                         <div class="flex flex-col sm:flex-row sm:items-center gap-3 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg">
                             <div class="flex items-center gap-3 flex-1 min-w-0">
                                 <flux:avatar :name="$user->name" size="sm" />
                                 <div class="min-w-0 flex-1">
                                     <div class="font-medium truncate">{{ $user->name }}</div>
                                     <div class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                         {{ $user->email }}
                                     </div>
                                 </div>
                             </div>
                             <div class="flex items-start gap-2">
                                 @if($user->id !== auth()->id())
                                     <livewire:app.library-update-share :library="$library" :user="$user" :key="'update-share-'.$user->id" />
                                 @endif
                                 <flux:badge 
                                     :icon="$user->pivot->role->icon()"
                                     size="sm"
                                 >
                                     {{ $user->pivot->role->label() }}
                                 </flux:badge>
                             </div>
                         </div>
                     @endforeach
                 </div>
            </div>

            {{-- Add share form --}}
            <div>
                <flux:heading class="mb-4">{{ __('app.library.add_share') }}</flux:heading>
                
                <form wire:submit="addShare" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <flux:field>
                            <flux:label for="form.email">{{ __('app.user.email') }}</flux:label>
                            <flux:input 
                                id="email"
                                wire:model="form.email" 
                                type="email" 
                                :placeholder="__('app.user.email')"
                            />
                            <flux:error name="form.email" />
                        </flux:field>

                        <flux:field>
                            <flux:label for="formrole">{{ __('app.library.role') }}</flux:label>
                            <flux:select wire:model="form.role">
                                <option value="">{{ __('app.library.select_role') }}</option>
                                @foreach(LibraryShareRole::applicableRoles() as $role)
                                    <option value="{{ $role->value }}">{{ $role->label() }}</option>
                                @endforeach
                            </flux:select>
                            <flux:error name="form.role" />
                        </flux:field>
                    </div>

                    <div class="flex justify-end">
                        <flux:button type="submit" variant="primary" size="sm">
                            {{ __('app.library.share') }}
                        </flux:button>
                    </div>
                </form>
            </div>
            
            <div class="flex justify-end gap-3">
                <flux:modal.close>
                    <flux:button variant="outline">
                        {{ __('actions.close') }}
                    </flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>
</div>
