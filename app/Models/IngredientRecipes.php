<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\Pivot;

class IngredientRecipes extends Pivot
{
    protected $table = 'ingredient_recipes';

    public $timestamps = true;
}
