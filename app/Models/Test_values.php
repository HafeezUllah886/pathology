<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test_values extends Model
{
    protected $guarded = [];

    public function group()
    {
        return $this->belongsTo(Test_groups::class);
    }

    protected $casts = [
        'options' => 'array',
    ];
}
