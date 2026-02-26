<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $fillable = [
        'ingredient_id',
        'amount',
        'expiry_date',
    ];

    /**
     * Get the ingredient this inventory entry belongs to.
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }
}
