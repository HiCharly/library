<div class="flex flex-col gap-6">
    <x-auth-header
        :title="__('auth.action.login_account')"
        :description="__('auth.message.enter_email_password')"
    />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    @if(!app()->isProduction())
        <flux:dropdown>
            <flux:button icon:trailing="chevron-down" class="w-full">{{ __('auth.action.login_as') }}</flux:button>

            <flux:menu>
                @foreach(App\Models\User::all() as $user)
                    <flux:menu.item wire:click="loginAs('{{ $user->id }}')" class="flex items-center gap-2">
                        {{ $user->name }}
                    </flux:menu.item>
                @endforeach
            </flux:menu>
        </flux:dropdown>
    @endif

    <form wire:submit="login" class="flex flex-col gap-6">
        <!-- Email Address -->
        <flux:input
            wire:model="email"
            :label="__('app.user.email')"
            type="email"
            required
            autofocus
            autocomplete="email"
            placeholder="email@example.com"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('app.user.password')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('app.user.password')"
                viewable
            />

            @if (Route::has('password.request'))
                <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                    {{ __('auth.action.forgot_password_question') }}
                </flux:link>
            @endif
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('auth.action.remember_me')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full">{{ __('auth.action.login') }}</flux:button>
        </div>
    </form>

    @if (Route::has('register'))
        <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-600 dark:text-zinc-400">
            <span>{{ __('auth.message.no_account') }}</span>
            <flux:link :href="route('register')" wire:navigate>{{ __('auth.action.register') }}</flux:link>
        </div>
    @endif
</div>
