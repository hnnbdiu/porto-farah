<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'description', 'tech_stack', 'github_url', 'demo_url', 'image', 'is_published', 'sort_order'
    ];

    protected $casts = [
        'tech_stack' => 'array',
        'is_published' => 'boolean',
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
}
