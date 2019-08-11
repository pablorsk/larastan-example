<?php
declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Chapter.
 *
 * @property int $id
 * @property int $book_id
 * @property string|null $title
 * @property int|null $ordering
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property \App\Book $book
 * @property \Illuminate\Database\Eloquent\Collection|\App\Photo[] $photos
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chapter whereBookId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chapter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chapter whereOrdering($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chapter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Chapter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Chapter extends Model
{
    protected $fillable = [
        'book_id',
        'title',
        'ordering',
    ];

    /* Just testing camelCase relations */

    public function privateBook()
    {
        return $this->belongsTo(Book::class, 'book_id', 'id');
    }

    /* BelongTo */

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    /* MorphBy */

    public function photos()
    {
        return $this->morphMany(Photo::class, 'photoable');
    }
}
