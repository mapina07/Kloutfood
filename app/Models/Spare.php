<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spare extends Model
{
    use HasFactory;

    protected $table = 'spare';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        "user_id",
        "ingredient_id",
        "spare_quantity"
    ];

    public function ingrediente()
    {
         return $this->belongsTo(Ingredient::class);
    }

    public function user()
    {
         return $this->belongsTo(User::class);
    }

}
