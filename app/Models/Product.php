<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'price',
        'image_path',
        'description',
        'is_available',
    ];

    /**
     * The ingredients that belong to the product.
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'product_ingredient')
            ->withPivot('amount')
            ->withTimestamps();
    }

    /**
     * Check if all ingredients for this product have sufficient stock.
     */
    public function hasSufficientStock()
    {
        foreach ($this->ingredients as $ingredient) {
            if ($ingredient->amount < $ingredient->pivot->amount) {
                return false;
            }
        }
        return true;
    }
}
