<?php
declare(strict_types=1);

namespace App;

class AuthorObserver
{
    public function saving(Author $author): bool
    {
        return true;
    }
}
