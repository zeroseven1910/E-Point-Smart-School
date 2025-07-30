<?php
// app/Models/ViolationAndAchievement.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ViolationAndAchievement extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'description',
        'point',
    ];

    public function points()
    {
        return $this->hasMany(Point::class, 'violation_id');
    }
}
