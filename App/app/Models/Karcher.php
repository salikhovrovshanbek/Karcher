<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karcher extends Model
{
    use HasFactory;

//    protected $fillable=[
//        'name',
//        'longitude',
//        'latitude',
//        'address',
//        'director',
//        'phone',
//        'countPersons',
//    ];
    protected $guarded=[];

    public function users()
    {
        return $this->hasMany(User::class,'karcher_id')->orderBy('id');
    }
}
