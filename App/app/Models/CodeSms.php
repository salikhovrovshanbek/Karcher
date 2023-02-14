<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeSms extends Model
{
    use HasFactory;

    protected $table = 'phone_verification_codes';
    protected $fillable = ['user_id', 'ip', 'phone', 'code', 'expires_at'];
}
