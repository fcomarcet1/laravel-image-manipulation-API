<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageManipulation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'path',
        'type',
        'data',
        'output_path',
        'user_id',
        'album_id',
        'created_at',
        'updated_at'
    ];
}
