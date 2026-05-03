<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantModel extends Model
{
    protected $table = 'product_variants';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'product_id',
        'size',
        'color',
        'price',
        'stock'
    ];
}