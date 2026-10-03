<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $fillable = [
        'title', 'description', 'image_path', 'thumbnail_path', 'category', 'sort_order', 'is_published'
    ];

    protected $casts = [
        'is_published' => 'boolean',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image_path) return asset('images/placeholder.jpg');
        return \Illuminate\Support\Facades\Storage::disk('public')->exists($this->image_path) 
            ? \Illuminate\Support\Facades\Storage::url($this->image_path) 
            : asset('images/placeholder.jpg');
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->thumbnail_path) return asset('images/placeholder.jpg');
        return \Illuminate\Support\Facades\Storage::disk('public')->exists($this->thumbnail_path) 
            ? \Illuminate\Support\Facades\Storage::url($this->thumbnail_path) 
            : asset('images/placeholder.jpg');
    }
}
