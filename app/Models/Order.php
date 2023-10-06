<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // associated the table in the database
    protected $table = 'orders'; 
    
    // Primary Key
    protected $primaryKey = 'orderID';

    //In Order model, define a relationship with the Menu model using Laravel's Eloquent ORM
    public function menus()
    {
        return $this->hasMany(Menu::class, 'menuID');
    }

    public function getTotalPrice()
    {
        return $this->menus->sum('totalPrice');
    }
}
