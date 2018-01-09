<?php

namespace storeHub;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $primaryKey = 'product_id';
    protected $fillable = ['product_code', 'product_name', 'product_detail', 'product_image', 'product_cost_price', 'product_sale_price', 'product_quantity', 'user_id'];
}
