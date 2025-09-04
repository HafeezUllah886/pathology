<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test_groups extends Model
{
    protected $guarded = [];

    public function test()
    {
        return $this->hasMany(Tests::class);
    }

}
