<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForgotPassword extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'is_sent' => 'boolean'
    ];
    protected $with = ['user'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
