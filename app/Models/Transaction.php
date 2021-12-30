<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user', 'room_category', 'room', 'payment_method', 'facility'];
    protected $casts = [
        'is_rated' => 'boolean',
        'facility_id' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function facility()
    {
        return $this->hasMany(Facility::class, 'id');
    }
}
