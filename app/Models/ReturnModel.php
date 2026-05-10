<?php

namespace App\Models;

use CodeIgniter\Model;

class ReturnModel extends Model
{
    protected $table         = 'returns';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['sale_id', 'variant_id', 'qty', 'reason', 'status'];

    protected $validationRules = [
        'sale_id'    => 'required|integer',
        'variant_id' => 'required|integer',
        'qty'        => 'required|integer|greater_than[0]',
        'status'     => 'in_list[pending,approved,rejected]',
    ];

    public function getWithDetails()
    {
        return $this->select('returns.id, returns.qty, returns.reason, returns.status, returns.created_at, product_variants.size, product_variants.color, products.product_name, sales.invoice_no')
            ->join('product_variants', 'product_variants.id = returns.variant_id', 'left')
            ->join('products', 'products.id = product_variants.product_id', 'left')
            ->join('sales', 'sales.id = returns.sale_id', 'left')
            ->orderBy('returns.id', 'DESC')
            ->findAll();
    }
}
