<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications'; 
    protected $primaryKey = 'notificationID';

    protected $fillable = ['isRead', 'content'];
    
    public function user()
    {
        return $this->belongsTo(UserAccounts::class, 'userID');
    }

    public static function unreadCount()
    {
        return Notification::where('isRead', false)->count();
    }
}
