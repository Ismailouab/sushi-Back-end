<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_price', 'status'];

    public function users()
    {
        return $this->belongsTo(Users::class);
    }

    public function food()
    {
        return $this->belongsToMany(Food::class, 'food_order')
                ->withPivot('quantity', 'total_price' )
                ->withTimestamps();
    }
    
    
    public function orderItems(){

        return $this->hasMany(OrderItem::class);  
    }

}

