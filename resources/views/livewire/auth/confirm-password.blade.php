<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('auth.action.confirm_password')"
        :description="__('auth.message.confirm_password_protect')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="confirmPassword" class="flex flex-col gap-6">
        <!-- Password -->
        <flux:input
            wire:model="password"
            :label="__('app.user.password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('app.user.password')"
            viewable
        />

        <flux:button variant="primary" type="submit" class="w-full">{{ __('auth.action.confirm') }}</flux:button>
    </form>
</div>
