<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['image', 'rating'];
    protected $casts = [
        'facility_id' => 'array'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) use ($filters) {
            return $query->where($filters['search_by'], 'like', '%' . $search . '%');
        });
    }

    public function getRouteKeyName()
    {
        return 'name';
    }

    public function room()
    {
        return $this->hasMany(Room::class);
    }

    public function image()
    {
        return $this->hasMany(RoomCategoryImage::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
}
