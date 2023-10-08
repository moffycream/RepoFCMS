<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccounts extends Model
{
    protected $table = 'user_accounts'; // associated the table in the database

    protected $primaryKey = 'userID'; 

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
