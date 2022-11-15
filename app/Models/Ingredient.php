<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        "name",
        "description",
        "um_id",
        "min_quantity",
        "price",
        "picture_url"
    ];

    public function um()
    {
        return $this->belongsTo(Um::class);
    }
}
