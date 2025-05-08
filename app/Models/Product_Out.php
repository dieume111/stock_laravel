<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_Out extends Model
{
    protected $table = 'product_out';
    protected $primaryKey = 'prout_id';
    protected $fillable = ['product_id','prout_date', 'prout_quantity',];
   
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
    
    }
   

   