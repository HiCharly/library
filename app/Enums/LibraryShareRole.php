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

    public static function applicableRoles(): array
    {
        return [
            self::VIEWER,
            self::EDITOR,
        ];
    }

    public function icon(): string
    {
        return match ($this) {
            self::VIEWER => 'eye',
            self::EDITOR => 'pencil-square',
            self::OWNER => 'user',
        };
    }
}
