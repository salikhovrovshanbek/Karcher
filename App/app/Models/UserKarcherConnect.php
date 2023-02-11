<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKarcherConnect extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function karcher()
    {
        return $this->belongsTo(Karcher::class,'connectWithUser_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'connectWithUser_id');
    }
}
