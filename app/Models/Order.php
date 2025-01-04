<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'food_id', 'quantity', 'total_price', 'status'];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function food()
    {
        return $this->belongsTo(Food::class);
    }
}

