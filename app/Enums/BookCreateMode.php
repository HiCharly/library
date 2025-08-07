<?php

namespace App\Enums;

enum BookCreateMode: string
{
    case SCAN = 'scan';
    case SEARCH = 'search';
    case MANUAL = 'manual';

    public function label(): string
    {
        return __('enums/book_create_mode.' . $this->name);
    }
}
