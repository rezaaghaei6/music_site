<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'slug',
        'artist_id',
        'release_date',
        'cover_image',
        'description',
        'is_featured',
        'is_active',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release_date' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get the artist that owns the album.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Get the songs for the album.
     */
    public function songs(): HasMany
    {
        return $this->hasMany(Song::class);
    }

    /**
     * Get the album's cover image URL.
     */
    public function getCoverUrlAttribute(): string
    {
        if ($this->cover_image) {
            return asset('storage/' . $this->cover_image);
        }
        
        return asset('images/default-album-cover.jpg');
    }

    /**
     * Get the album's formatted release date.
     */
    public function getFormattedReleaseDateAttribute(): ?string
    {
        return $this->release_date?->format('Y/m/d');
    }

    /**
     * Get the album's status badge HTML.
     */
    public function getStatusBadgeAttribute(): string
    {
        if ($this->is_active) {
            return '<span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded">فعال</span>';
        }
        
        return '<span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded">غیرفعال</span>';
    }

    /**
     * Get the album's featured badge HTML.
     */
    public function getFeaturedBadgeAttribute(): string
    {
        if ($this->is_featured) {
            return '<span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">ویژه</span>';
        }
        
        return '';
    }

    /**
     * Scope a query to only include active albums.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope a query to only include featured albums.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get the number of songs in the album.
     */
    public function getSongsCountAttribute(): int
    {
        return $this->songs()->count();
    }

    /**
     * Get the total duration of all songs in the album.
     */
    public function getTotalDurationAttribute(): string
    {
        $totalSeconds = $this->songs()->sum('duration');
        $minutes = floor($totalSeconds / 60);
        $seconds = $totalSeconds % 60;
        
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    /**
     * Delete the model from the database.
     */
    public function delete()
    {
        // حذف تصویر کاور در صورت وجود
        if ($this->cover_image) {
            Storage::delete('public/' . $this->cover_image);
        }

        return parent::delete();
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted()
    {
        static::creating(function ($album) {
            // اگر اسلاگ تنظیم نشده باشد، آن را از عنوان بساز
            if (empty($album->slug)) {
                $album->slug = Str::slug($album->title);
            }
        });

        static::updating(function ($album) {
            // اگر عنوان تغییر کرده و اسلاگ دستی تنظیم نشده، اسلاگ را به‌روز کن
            if ($album->isDirty('title') && !$album->isDirty('slug')) {
                $album->slug = Str::slug($album->title);
            }
        });
    }
}