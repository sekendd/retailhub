<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table         = 'sales';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['invoice_no', 'user_id', 'total'];

    protected $validationRules = [
        'invoice_no' => 'required|max_length[50]',
        'user_id'    => 'required|integer',
        'total'      => 'required|decimal',
    ];

    public function getWithItems(int $saleId)
    {
        return $this->select('sales.*, sale_items.qty, sale_items.price, product_variants.size, product_variants.color, products.product_name')
            ->join('sale_items', 'sale_items.sale_id = sales.id', 'left')
            ->join('product_variants', 'product_variants.id = sale_items.variant_id', 'left')
            ->join('products', 'products.id = product_variants.product_id', 'left')
            ->where('sales.id', $saleId)
            ->findAll();
    }

    public function generateInvoiceNo(): string
    {
        $last = $this->orderBy('id', 'DESC')->first();
        $next = $last ? ((int) substr($last['invoice_no'], 4)) + 1 : 1;
        return 'INV-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }
}
