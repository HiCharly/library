@props(['book'])

<div class="rounded-lg flex flex-row justify-start items-stretch w-full border border-neutral-200/60 overflow-hidden">
    @if($book->thumbnail_url)
        <div class="aspect-[2/3] w-33/100 bg-cover bg-center"
            style="background-image: url('{{ $book->thumbnail_url }}');">
        </div>
    @else
        <div class="aspect-[2/3] w-33/100 bg-neutral-100 flex items-center justify-center">
            <flux:icon.book-open-text class="size-10 text-neutral-600" />
        </div>
    @endif
    <div class="w-full flex flex-col p-4 gap-2">
        <flux:heading>{{ $book->title }}</flux:heading>

        <flux:text class="text-xs line-clamp-3 text-neutral-700 ">
            {{ $book->description }}
        </flux:text>

        <div class="flex flex-col items-start gap-1 text-sm">
            <div class="flex flex-row items-center gap-2">
                <flux:icon.users class="size-3" />
                <flux:text class="line-clamp-1" class="text-xs" variant="strong">
                    {{ $book->author }}
                </flux:text>
            </div>
            <div class="flex flex-row items-center gap-2">
                <flux:icon.building-library class="size-3" />
                <flux:text class="line-clamp-1" class="text-xs" variant="strong">
                    {{ $book->publisher }}
                </flux:text>
            </div>
            <div class="flex flex-row items-center gap-2">
                <flux:icon.calendar class="size-3" />
                <flux:text class="line-clamp-1" class="text-xs" variant="strong">
                    {{ $book->published_at?->format('d/m/Y') }}
                </flux:text>
            </div>
        </div>

        <flux:spacer/>

        {{ $slot }}
    </div>
</div>
