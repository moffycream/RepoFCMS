<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'membership'; // table name

    protected $fillable = ['userID', 'tier_level', 'total_payments']; // fields that can be mass-assigned

    public function userAccount()
    {
        return $this->belongsTo(UserAccounts::class, 'userID', 'userID');
    }
}
