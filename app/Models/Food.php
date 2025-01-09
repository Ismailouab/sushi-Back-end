<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Food extends Model
{
    use HasFactory;
    protected $table = 'foods'; 
    protected $fillable = ['name', 'description', 'price', 'image', 'category_id', 'rating'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function order(){

        return $this->belongsToMany(Order::class, 'food_order')  // Specify pivot table
                ->withPivot('quantity', 'total_price')  // Include pivot data
                ->withTimestamps();  // Include timestamps from the pivot table
    }
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
