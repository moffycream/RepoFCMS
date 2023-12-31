<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods'; // associated the table in the database


    protected $primaryKey = 'foodID'; 


    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_food', 'menuID', 'foodID');
    }

    public function inventory()
    {
        return $this->belongsToMany(Inventory::class, 'food_inventory', 'foodID', 'inventoryID');
    }

    public function food_inventory() {
        return $this->hasMany(FoodInventory::class, 'foodID', 'foodID');
    }
}
