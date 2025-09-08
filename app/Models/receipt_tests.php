<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class receipt_tests extends Model
{
    protected $guarded = [];

    public function receipt()
    {
        return $this->belongsTo(receipt::class);
    }

    public function test()
    {
        return $this->belongsTo(Tests::class);
    }
}
