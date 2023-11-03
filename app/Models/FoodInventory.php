<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FoodInventory extends Model
{
    protected $table = 'food_inventory'; // associated the table in the database

    protected $primaryKey = 'id'; 

    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_inventory', 'foodID', 'inventoryID');
    }

    public function inventory() {
        return $this->belongsTo(Inventory::class, 'inventoryID', 'inventoryID');
    }
}
