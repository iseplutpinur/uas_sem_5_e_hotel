<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['category'];
    protected $casts = [
        'is_available' => 'boolean'
    ];

    public function category()
    {
        return $this->belongsTo(RoomCategory::class, 'room_category_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) use ($filters) {
            return $query->where($filters['search_by'], 'like', '%' . $search . '%');
        });

        $query->when($filters['room_category'] ?? false, function ($query, $category) {
            return $query->where('room_category_id', $category);
        });
    }
}
