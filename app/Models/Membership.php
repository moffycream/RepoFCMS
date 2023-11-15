<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    protected $table = 'membership'; // table name

    protected $primaryKey = 'membershipID';

    protected $fillable = ['userID', 'tier_level', 'total_payments', 'discount_amount', 'last_reset_date']; // fields that can be mass-assigned

    public function userAccount()
    {
        return $this->belongsTo(UserAccounts::class, 'userID', 'userID');
    }
}
