<?php
declare(strict_types=1);

namespace App;

class SeriesObserver
{
    public function saving(Series $series): bool
    {
        return $series->title !== 'ThisTitleIsBlockedBySeriesObserver';
    }
}
