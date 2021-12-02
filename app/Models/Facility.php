<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'is_addon' => 'boolean'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) use ($filters) {
            return $query->where($filters['search_by'], 'like', '%' . $search . '%');
        });
    }
}
