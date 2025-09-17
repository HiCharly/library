<?php

namespace App\Enums;

enum LibraryShareRole: string
{
    case Owner = 'owner';
    case Editor = 'editor';
    case Viewer = 'viewer';
}
