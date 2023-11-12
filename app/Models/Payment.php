<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment_info'; // associated the table in the database

    public function order()
    {
        return $this->belongsTo(Order::class, 'orderID');
    }

    public function user()
    {
        return $this->belongsTo(UserAccounts::class, 'userID', 'userID');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class);
    }
}
