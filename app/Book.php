<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Book.
 *
 * @property int $id
 * @property int $author_id
 * @property int|null $series_id
 * @property int $isbn
 * @property string $date_published
 * @property string|null $title
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \App\Author $author
 * @property \Illuminate\Database\Eloquent\Collection|\App\Chapter[] $chapters
 * @property \Illuminate\Database\Eloquent\Collection|\App\Photo[] $photos
 * @property \App\Series|null $series
 * @property \Illuminate\Database\Eloquent\Collection|\App\Store[] $stores
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereDatePublished($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereIsbn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereSeriesId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Book whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Book withTrashed()
 *
 * @mixin \Eloquent
 */
class Book extends Model
{
    use SoftDeletes;

    protected $observables = ['finalSaved'];

    protected $dates = [
        'date_published',
    ];

    protected $fillable = [
        'title',
        'date_published',
    ];

    protected static $rules = [
        'author_id' => 'required',
    ];

    protected static function boot(): void
    {
        parent::boot();
        parent::observe(BookObserver::class);
    }

    /* BelongTo */

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function series()
    {
        return $this->belongsTo(Series::class);
    }

    /* HasMany */

    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }

    public function getChaptersQtyAttribute(): int
    {
        return $this->chapters()->count();
    }

    /* BelongToMany */

    public function books()
    {
        return $this->belongsToMany(self::class, 'book_book', 'parent_book_id', 'book_id');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'book_store')
            ->withTimestamps();
    }

    /* MorphBy */

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
}
