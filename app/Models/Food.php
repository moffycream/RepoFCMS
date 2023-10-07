<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    protected $table = 'foods'; // associated the table in the database

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_food', 'menuID', 'foodID');
    }
}
