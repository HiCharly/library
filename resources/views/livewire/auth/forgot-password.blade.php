<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('auth.action.forgot_password')"
        :description="__('auth.message.enter_email_reset')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('app.user.email')"
            type="email"
            required
            autofocus
            placeholder="email@example.com"
        />

        <flux:button variant="primary" type="submit" class="w-full">{{ __('auth.action.send_reset_link') }}</flux:button>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400">
        <span>{{ __('auth.message.or_return_to') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('auth.action.login') }}</flux:link>
    </div>
</div>
