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

    public $timestamps = true;

    protected $fillable = ['status_update_time'];

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
        $totalPrice = $this->menus->sum('totalPrice');
        $formattedTotalPrice = number_format($totalPrice, 2);
        return $formattedTotalPrice;
    }

    public function getformattedTime()
    {
        return Carbon::parse($this->attributes['created_at'])->format('h:i A');
    }

    public function getformattedDate()
    {
        return Carbon::parse($this->attributes['created_at'])->format('d F Y');
    }

    public function getformattedDateTime()
    {
        return Carbon::parse($this->attributes['created_at'])->format('Y-m-d h:i A');
    }

    public function getFormattedDateTimeComplete()
    {
        return Carbon::parse($this->attributes['updated_at'])->format('Y-m-d h:i A');
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'orderID');
    }
}
