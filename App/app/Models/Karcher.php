<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karcher extends Model
{
    use HasFactory;

    protected $fillable=[
        'name',
        'longitude',
        'latitude',
        'address',
        'director',
        'phone',
        'countPersons',
    ];

    public function user()
    {
        return $this->hasMany(User::class)->orderBy('id');
    }
}
