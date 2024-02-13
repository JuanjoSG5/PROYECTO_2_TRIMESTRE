<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'priority',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function categories() {
        return $this->belongsToMany(Category::class);
    }

    public function routines() {
        return $this->belongsToMany(Routine::class);
    }

    public static function boot(){
        parent::boot();
        static::creating(function ($event) {
        if (empty($event->start_date)) {
            $event->start_date = now(); // Set the start_date only if it's not provided
        }
    });
    }
}
