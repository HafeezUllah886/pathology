<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test_groups extends Model
{
    protected $guarded = [];

    public function test()
    {
        return $this->belongsTo(Tests::class);
    }

    public function values()
    {
        return $this->hasMany(Test_values::class, 'test_group_id', 'id');
    }
}
