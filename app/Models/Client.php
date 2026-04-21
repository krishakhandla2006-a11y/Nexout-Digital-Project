<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    // $fillable માં નવા ફિલ્ડ્સ ઉમેર્યા છે
    protected $fillable = [
        'name',
        'address',
        'phone',
        'account_holder',
        'bank_name',
        'account_no',
        'ifsc_code'
    ];
}