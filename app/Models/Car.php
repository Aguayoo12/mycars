<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'plate',
        'marca',
        'model',
        'year',
        'last_revision',
        'image',
        'price',
        'user_id'
    ];

    public function userCar(){
        return $this->belongsTo(User::class, 'user_id');
    }
}
