@props([
    'icon',
    'title',
    'description',
])

<div class="flex flex-col items-center justify-center py-8 text-center">
    <flux:icon :name="$icon" class="w-12 h-12 text-neutral-400 mb-4" />

    <flux:heading level="2" class="text-lg font-semibold text-neutral-900 dark:text-neutral-100">
        {{ $title }}
    </flux:heading>

    <flux:text class="mt-2 max-w-md text-neutral-500 dark:text-neutral-400">
        {{ $description }}
    </flux:text>

    {{ $slot }}
</div>
