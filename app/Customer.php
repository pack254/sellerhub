<?php

namespace storeHub;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $primaryKey = 'customer_id';
    protected $fillable = ['customer_firstname', 'customer_lastname', 'customer_address', 'customer_phone', 'customer_email','user_id'];
}
