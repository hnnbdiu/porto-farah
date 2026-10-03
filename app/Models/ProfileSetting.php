<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 'role', 'bio', 'foto', 'cv_path', 'sosial_media'
    ];

    protected $casts = [
        'sosial_media' => 'array',
    ];
}
