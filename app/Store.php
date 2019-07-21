<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property-read Product[] $products
 */
class Store extends Model
{
    protected $fillable = ['name', 'desc'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
