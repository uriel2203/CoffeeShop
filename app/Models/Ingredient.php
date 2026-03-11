<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'amount',
        'unit',
        'low_stock_threshold',
        'critical_stock_threshold',
    ];

    /**
     * Get the inventory history for this ingredient.
     */
    /**
     * The products that belong to the ingredient.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_ingredient')
            ->withPivot('amount')
            ->withTimestamps();
    }
}
