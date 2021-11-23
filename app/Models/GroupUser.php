<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupUser extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        '1_1' => 'boolean',
        '1_2' => 'boolean',
        '1_3' => 'boolean',
        '1_4' => 'boolean'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) use ($filters) {
            return $query->where($filters['search_by'], 'like', '%' . $search . '%');
        });
    }
}
