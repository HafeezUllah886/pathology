<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tests extends Model
{
    protected $guarded = [];

    public function groups()
    {
        return $this->belongsToMany(Test_groups::class);
    }

    public function values()
    {
        return $this->hasMany(Test_values::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
