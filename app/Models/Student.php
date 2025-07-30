<?php
// app/Models/Student.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nis',
        'class_id',
        'user_id',
    ];

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function points()
    {
        return $this->hasMany(Point::class);
    }

    public function getTotalPointsAttribute()
    {
        return $this->points()
            ->join('violations_and_achievements', 'points.violation_id', '=', 'violations_and_achievements.id')
            ->sum('violations_and_achievements.point');
    }
}
