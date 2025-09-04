<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test_parameters extends Model
{
    protected $guarded = [];

    public function test()
    {
        return $this->belongsTo(tests::class);
    }
    
    protected $casts = [
        'options' => 'array',
    ];
   
}
