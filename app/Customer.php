<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use League\CommonMark\Block\Element\Document;

class Customer extends Model
{
    protected $fillable = ['name', 'email', 'document'];

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }
}
