<?php
declare(strict_types=1);

namespace App;

class BookObserver
{
    public function saving(Book $book): bool
    {
        return true;
    }
}
