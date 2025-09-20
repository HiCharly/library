<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('settings.appearance')" :subheading="__('settings.appearance_subheading')">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance" disabled>
            <flux:radio value="light" icon="sun">{{ __('settings.light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('settings.dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('settings.system') }}</flux:radio>
        </flux:radio.group>

        <flux:callout icon="clock" class="mt-4">
            <flux:callout.heading>Bientôt disponible</flux:callout.heading>
            <flux:callout.text>
                Le développement du thème sombre est en cours. Pour le moment, l'application utilise le thème clair par défaut.
            </flux:callout.text>
        </flux:callout>
    </x-settings.layout>
</section>