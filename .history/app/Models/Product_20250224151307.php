<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $casts = [
        'additional_images' => 'array', // Cast JSON to array automatically
    ];

    // The table associated with the model
    protected $table = 'products';

    // The attributes that are mass assignable
    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'product_image' => 'array',
        'category_id',
    ];

    // Define the relationship with the Category model
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    protected $appends = ['first_image'];

    public function getFirstImageAttribute()
    {
        $images = json_decode($this->product_image, true);

        if (is_array($images) && !empty($images)) {
            return asset('storage/' . $images[0]);
        }

        return asset('images/default-placeholder.png'); // Fallback image
    }

    // Optional: Define an accessor for the product image URL
     // Define an accessor for the image URL
     public function getImageUrlAttribute()
     {
         return $this->product_image
             ? asset('storage/' . $this->product_image)
             : asset('images/default-placeholder.png');
     }

    public function orderItems()
    {
    return $this->hasMany(OrderItem::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function cartItems()
    {
    return $this->hasMany(CartItem::class);
    }

}
