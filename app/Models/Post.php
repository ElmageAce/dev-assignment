<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'publication_date',
        'slug'
    ];

    /**
     * @param int $per_page
     * @param string $sort_by
     * @param string $direction
     *
     * @return Paginator
     */
    public static function paginatePosts(
        int $per_page,
        string $sort_by = 'id',
        string $direction = 'desc'
    ): Paginator
    {
        return self::with(['user'])
            ->orderBy($sort_by, $direction)
            ->simplePaginate($per_page);
    }

    final public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
