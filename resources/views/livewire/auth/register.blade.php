<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('auth.action.register_account')"
        :description="__('auth.message.enter_details_register')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input
            wire:model="name"
            :label="__('app.user.name')"
            type="text"
            required
            autofocus
            autocomplete="name"
            :placeholder="__('app.user.full_name')"
        />

        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('app.user.email')"
            type="email"
            required
            autocomplete="email"
            placeholder="email@example.com"
        />

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

        <!-- Confirm Password -->
        <flux:input
            wire:model="password_confirmation"
            :label="__('auth.action.confirm_password')"
            type="password"
            required
            autocomplete="new-password"
            :placeholder="__('auth.action.confirm_password')"
            viewable
        />

        <div class="flex items-center justify-end">
            <flux:button type="submit" variant="primary" class="w-full">
                {{ __('auth.action.create_account') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
        <span>{{ __('auth.message.already_account') }}</span>
        <flux:link :href="route('login')" wire:navigate>{{ __('auth.action.login') }}</flux:link>
    </div>
</div>
