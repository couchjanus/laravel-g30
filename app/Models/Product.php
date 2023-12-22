<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'price', 'category_id', 'brand_id', 'status', 'cover'];

    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    public function brand()     
    {
        return $this->belongsTo(Brand::class);
    }

    
    public function category()     
    {
        return $this->belongsTo(Category::class);
    }

    // public function categories(): BelongsToMany
    // {
    //     return $this->belongsToMany(Category::class);
    // }

}
