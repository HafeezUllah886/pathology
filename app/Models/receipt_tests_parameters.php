<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class receipt_tests_parameters extends Model
{
    protected $guarded = [];

    public function receipt_test()
    {
        return $this->belongsTo(receipt_tests::class);
    }

   
}
