<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Um extends Model
{
    use HasFactory;

    protected $table = 'ums';

    protected $primaryKey = 'id';

    public $timestamps = true;

    protected $fillable = [
        "name",
        "description"
    ];

    public function ingredientes()
    {
        return $this->hasOne('App\Models\Ingredient');
    }
}
