<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        "user_id",
        "recipe_id",
        "costo"
    ];

    public function recipe()
    {
         return $this->belongsTo(Recipe::class);
    }

    public function user()
    {
         return $this->belongsTo(User::class);
    }

        /**
     * Get the comments for the blog post.
     */
    public function ingredientsCart()
    {
        return $this->hasMany(IngredientCart::class);
    }

}
