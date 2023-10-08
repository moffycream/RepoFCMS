<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Order extends Model
{
    // associated the table in the database
    protected $table = 'orders'; 

    protected $primaryKey = 'orderID'; 

    protected $casts = [
        'created-at' => 'datetime:d F Y g:i A'
    ];

    //In Order model, define a relationship with the Menu model using Laravel's Eloquent ORM
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'order_menu', 'orderID', 'menuID');
    }

    public function user()
    {
        return $this->belongsTo(UserAccounts::class, 'userID');
    }

    public function getTotalPrice()
    {
        return $this->menus->sum('totalPrice');
    }

    public function getformattedDateTime()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d F Y g:i A');
    }
}
