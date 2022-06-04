<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'checkin_date',
        'is_confirmed',
        'user_id'
    ];
    protected $attributes = [
        'is_confirmed' => false,
    ];
}
