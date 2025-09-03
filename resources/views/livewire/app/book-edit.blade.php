<form wire:submit="update">
    <x-books.book-form-fields :$form :$book />

    <div class="flex">
        <flux:button x-on:click="window.history.back()">{{ __('actions.back') }}</flux:button>
        <flux:spacer />
        <flux:button type="submit" variant="primary">{{ __('actions.edit') }}</flux:button>
    </div>
</form>
