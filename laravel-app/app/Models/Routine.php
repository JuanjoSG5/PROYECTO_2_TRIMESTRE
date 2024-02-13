<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'start_date',
        'end_date',
        'user_id',
        'event_id'
    ];

    public function events() {
        return $this->belongsToMany(Event::class);
    }
    public static function boot(){
        parent::boot();
        static::creating(function ($routine) {
            if (empty($routine->start_date)) {
                $routine->start_date = now(); 
            }
        });
    }
}