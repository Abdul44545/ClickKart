<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'AccountTitle',
        'AccountNumber',
        'BankName',
        'IBANNumber',
        'BranchCode',
        'MobileNumber',
        'user_id',
        'method',
        'status',
    ];

}