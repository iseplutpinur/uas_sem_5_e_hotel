<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user', 'room_category', 'payment_method'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }
}
