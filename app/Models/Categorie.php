<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;
    //file kolom berada pada table level di database//
    protected $fillable =[
        'categorie','is_active',

    ];

    /*penjelasan:
     1 categori bisa memilih beberapa product */
     public function product(): HasMany
     {
        return $this->hasMany(Product::class);
     }
}
