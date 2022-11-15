<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Recipe extends Model
{
    use UUID;
    use HasFactory;

    protected $table = 'recipes';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        "name",
        "category_id",
        "instructions",
        "picture_url"
    ];

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }

    public function ingredientes()
    {
        return $this->belongsToMany(Ingredient::class,'ingredient_recipes','recipe_id','ingredient_id')
            ->withPivot(['quantity']);
    }

    public function maxPrice()
    {
        $maxPrice = 0;
        foreach ($this->ingredientes as $ingredient)
        {
            $min_cuant = $ingredient->min_quantity;
            $rec_cuant = $ingredient->pivot->quantity;
            $precio = $ingredient->price;

            $cant = 1;
            while($min_cuant <  $rec_cuant){
                $cant+=1;
                $min_cuant += $min_cuant;
            }
            $precio_ingrediente_receta = $cant * $precio;

            $maxPrice += $precio_ingrediente_receta;
        }

        return $maxPrice;
    }


}
