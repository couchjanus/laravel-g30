<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = ['title', 'content', 'user_id', 'status', 'cover', 'published_at',];

    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
        
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    public function scopeWithTag($query, string $tag)
    {
        $query->whereHas('tags', function ($query) use ($tag) {
            $query->where('slug', $tag);
        });
    }


    public function scopeStatus($query)
    {
        $query->where('status', 1);
    }

    public function scopePopular($query)
    {
        $query->withCount('likes')
            ->orderBy("likes_count", 'desc');
    }

    public function scopeSearch($query, string $search = '')
    {
        $query->where('title', 'like', "%{$search}%");
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    public function getReadingTime()
    {
        return Str::readDuration($this->content);
        // $mins = round(str_word_count($this->content) / 250);

        // return ($mins < 1) ? 1 : $mins;

    }

    public function getThumbnailUrl()
    {
        $isUrl = str_contains($this->cover, 'http');
        return ($isUrl) ? $this->cover : asset(Storage::url($this->cover));
    }

}



