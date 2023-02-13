<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karcher extends Model
{
    use HasFactory;
    protected $table = 'karchers';

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

    public function connectWithUser()
    {
        return $this->hasMany(UserKarcherConnect::class,'karcher_id');
    }
}
