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

    public function user()
    {
        return $this->belongsTo(User::class, 'result_entered_by');
    }

    public function parameters()
    {
        return $this->belongsTo(receipt_tests_parameters::class);
    }

    public function status()
    {
        return $this->parameters()->count() > 0 ? "Result Entered" : "Pending";;
    }
}
