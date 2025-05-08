<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $primaryKey = 'product_id';
    protected $fillable = [ 'product_name','product_price','stock', ];
    public $timestamps = true;

    public function productIn()
    {
        return $this->hasMany(Product_In::class, 'product_id', 'product_id');
    }
    public function productOut()
    {
        return $this->hasMany(Product_Out::class, 'product_id', 'product_id');
    }
}
