<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $price
 * @property-read Store $store
 */
class Product extends Model
{
    protected $fillable = ['name', 'price'];

    public function store()
    {
        return $this->belongsTo(Store::class);
    }
}
