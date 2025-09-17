<?php

namespace App\Enums;

enum LibraryShareRole: string
{
    case VIEWER = 'viewer';
    case EDITOR = 'editor';
    case OWNER = 'owner';

    public function label(): string
    {
        return __('enums/library_share_role.' . $this->name);
    }
}
