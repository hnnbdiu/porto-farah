<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'type', 'summary', 'description', 'image', 'tags', 'date'
    ];

    protected $casts = [
        'tags' => 'array',
        'date' => 'date',
    ];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/placeholder.jpg');
        }
        
        if (\Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($this->image)) {
            return \Illuminate\Support\Facades\Storage::url($this->image);
        }

        return asset('images/placeholder.jpg');
    }

    public function getThumbnailUrlAttribute()
    {
        if (!$this->image) {
            return asset('images/placeholder.jpg');
        }
        
        if (\Illuminate\Support\Str::startsWith($this->image, ['http://', 'https://'])) {
            return $this->image;
        }

        $thumbPath = str_replace('achievements/', 'achievements/thumb_', $this->image);

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($thumbPath)) {
            return \Illuminate\Support\Facades\Storage::url($thumbPath);
        }

        if (\Illuminate\Support\Facades\Storage::disk('public')->exists($this->image)) {
            return \Illuminate\Support\Facades\Storage::url($this->image);
        }

        return asset('images/placeholder.jpg');
    }
}
