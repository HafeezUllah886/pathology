<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class receipt extends Model
{
    protected $guarded = [];

    public function receipt_tests()
    {
        return $this->hasMany(receipt_tests::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'entered_by');
    }
}
