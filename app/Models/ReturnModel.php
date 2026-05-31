<?php

namespace App\Models;

use CodeIgniter\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'sale_id',
        'variant_id',
        'qty',
        'reason',
        'status'
    ];
}