@props([
    'name' => 'q',
    'placeholder' => __('actions.search') . '...',
    'value' => null,
])

<label class="relative">
    <flux:input type="text" placeholder="{{ $placeholder }}" class:input="pl-8" :$attributes />

    <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
        <flux:icon.magnifying-glass class="size-4 text-neutral-500"/>
    </span>
</label>
