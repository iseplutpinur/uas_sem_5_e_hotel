<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['user'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['room_category_id'] ?? false, function ($query, $category) {
            return $query->where('room_category_id', $category);
        });

        $query->when($filters['user_id'] ?? false, function ($query, $user) {
            return $query->where('user_id', $user);
        });

        $query->when($filters['transaction_id'] ?? false, function ($query, $transaction) {
            return $query->where('transaction_id', $transaction);
        });
    }

    public function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
