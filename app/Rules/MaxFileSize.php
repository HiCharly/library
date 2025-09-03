<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class MaxFileSize implements ValidationRule
{
    protected int $maxBytes;

    public function __construct()
    {
        $this->maxBytes = config('media-library.max_file_size');
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value && $value->getSize() > $this->maxBytes) {
            $maxMo = round($this->maxBytes / 1024 / 1024);
            $fail("Le fichier :attribute ne doit pas dépasser {$maxMo} Mo.");
        }
    }
}
