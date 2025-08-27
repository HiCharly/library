<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('settings.appearance')" :subheading="__('settings.appearance_subheading')">
        <flux:radio.group x-data variant="segmented" x-model="$flux.appearance">
            <flux:radio value="light" icon="sun">{{ __('settings.light') }}</flux:radio>
            <flux:radio value="dark" icon="moon">{{ __('settings.dark') }}</flux:radio>
            <flux:radio value="system" icon="computer-desktop">{{ __('settings.system') }}</flux:radio>
        </flux:radio.group>
    </x-settings.layout>
</section>
