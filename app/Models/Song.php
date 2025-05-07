<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Song extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'artist_id',
        'album_id',
        'genre_id',
        'file_path',
        'cover',
        'duration',
        'plays',
        'slug',
        'is_featured',
    ];

    /**
     * Get the artist that owns the song.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the album that owns the song.
     */
    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Get the genre that owns the song.
     */
    public function genre(): BelongsTo
    {
        return $this->belongsTo(Genre::class);
    }

    /**
     * The playlists that belong to the song.
     */
    public function playlists(): BelongsToMany
    {
        return $this->belongsToMany(Playlist::class)
                    ->withPivot('order')
                    ->withTimestamps();
    }
}