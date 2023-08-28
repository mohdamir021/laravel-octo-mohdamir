<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theaterslot extends Model
{
    use HasFactory;

    protected $fillable = [
        'movie_id',
        'theater_id',
        'start_time',
        'end_time',
        'room_no'
    ];
}
