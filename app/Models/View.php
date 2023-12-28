<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $fillable = [
        'qty_views',
        'lesson_id',
        'user_id',
    ];

    public function lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
