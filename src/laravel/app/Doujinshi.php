<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doujinshi extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $attributes = [
        'product_id' => '',
        'book_name' => '',
        'shop_page_url' => '',
        'online_stock_status' => '',
        'shop_name' => '',
    ];
}
