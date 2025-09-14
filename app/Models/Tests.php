<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    protected $guarded = [];

    public function parameters()
    {
        return $this->hasMany(Test_parameters::class);
    }

    public function group()
    {
        return $this->belongsTo(Test_groups::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    protected $casts = [
        'remarks' => 'array',
    ];
}
