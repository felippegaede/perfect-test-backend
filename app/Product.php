<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image'];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
