<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTPCode extends Model
{
    use HasFactory;
    protected $table = 'otp_codes';

    protected $fillable = ['user_id', 'otp', 'expires_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

