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
        '1_4' => 'boolean',
        '2_1' => 'boolean',
        '2_2' => 'boolean',
        '2_3' => 'boolean',
        '2_4' => 'boolean',
        '3_1' => 'boolean',
        '3_2' => 'boolean',
        '3_3' => 'boolean',
        '3_4' => 'boolean',
        '4_1' => 'boolean',
        '4_2' => 'boolean',
        '4_3' => 'boolean',
        '4_4' => 'boolean',
        '5_1' => 'boolean',
        '5_2' => 'boolean',
        '5_3' => 'boolean',
        '5_4' => 'boolean',
        '6_1' => 'boolean',
        '6_2' => 'boolean',
        '6_3' => 'boolean',
        '6_4' => 'boolean',
        '7_1' => 'boolean',
        '7_2' => 'boolean',
        '7_3' => 'boolean',
        '7_4' => 'boolean',
        '8_1' => 'boolean',
        '8_2' => 'boolean',
        '8_3' => 'boolean',
        '8_4' => 'boolean',
        '9_1' => 'boolean',
        '9_2' => 'boolean',
        '9_3' => 'boolean',
        '9_4' => 'boolean',
        '10_1' => 'boolean',
        '10_2' => 'boolean',
        '10_3' => 'boolean',
        '10_4' => 'boolean',
        '11_1' => 'boolean',
        '11_2' => 'boolean',
        '11_3' => 'boolean',
        '11_4' => 'boolean',
        '12_1' => 'boolean',
        '12_2' => 'boolean',
        '12_3' => 'boolean',
        '12_4' => 'boolean',
        '13_1' => 'boolean',
        '13_2' => 'boolean',
        '13_3' => 'boolean',
        '13_4' => 'boolean'
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) use ($filters) {
            return $query->where($filters['search_by'], 'like', '%' . $search . '%');
        });
    }
}
