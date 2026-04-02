<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'menu_id',
        'quantity',
        'total_price',
        'status',
        'payment_proof',  
        'payment_status',
    ];

    // Relasi ke Menu 
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    // Relasi ke User supaya Admin tahu siapa yang beli
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}