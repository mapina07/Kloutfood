<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categorys';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        "name",
        "description",
        "picture_url"
    ];

    public function ingredientes()
    {
        return $this->hasOne('App\Models\Ingredient');
    }
}
