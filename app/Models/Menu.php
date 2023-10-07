<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus'; // associated the table in the database

    protected $primaryKey = 'menuID'; 

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_menu', 'orderID', 'menuID');
    }

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'menu_food', 'menuID', 'foodID');
    }
}
