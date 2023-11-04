<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment_info'; // associated the table in the database

    protected $primaryKey = 'orderID'; 

    protected $casts = [
        'created-at' => 'datetime:d F Y g:i A'
    ];

    public function user()
    {
        return $this->belongsTo(UserAccounts::class, 'userID');
    }

}
