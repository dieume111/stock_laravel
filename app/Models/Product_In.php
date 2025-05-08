<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_In extends Model
{
    protected $table = 'product_in';
    protected $primaryKey = 'prin_id';
    protected $fillable = [
        'product_id',
        'prin_date',
        'prin_quantity',
        'unit_price'
     ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    
    }
    
}
