<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IngredientCart extends Model
{
    use HasFactory;

    protected $table = 'ingredient_cart';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        "ingredient_id",
        "recipe_id",
        "real_sales_quantity",
        "costo"
    ];

     /**
     * Get the recipe that owns the IngredientCart.
     */
    public function recipe()
    {
         return $this->belongsTo(Recipe::class);
    }

     /**
     * Get the user that owns the IngredientCart.
     */
    public function user()
    {
         return $this->belongsTo(User::class);
    }

    /**
     * Get the cart that owns the IngredientCart.
     */
    public function cart()
    {
         return $this->belongsTo(Cart::class);
    }

    /**
     * Get the ingredient that owns the IngredientCart.
     */
    public function ingredient()
    {
        return $this->belongsTo(Ingredient::class);
    }

}
