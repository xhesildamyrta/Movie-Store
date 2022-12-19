<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
      'title', 'trailerURL', 'videoURL', 'runtime',
        'description', 'rating', 'yearOfRelease', 'photoURL',
        'rentalPrice'
    ];
    use HasFactory;
}
