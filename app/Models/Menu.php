<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus'; // associated the table in the database

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }
}
