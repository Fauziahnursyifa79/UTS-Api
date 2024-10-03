<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable =[
        'categorie_id',
        'product',
        'description',
        'price',
        'stock',
        'image',
    ];


    /*penjelasan :
    1 product hanya mempunyai 1 categorie*/
    public function categorie(): BelongsTo
    {
        return $this->belongsTo(Categorie::class);
    }

    /*penjelasan :
    1 product hanya mempunyai 1 user*/
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


}
