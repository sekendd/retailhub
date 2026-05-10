<?php

namespace App\Models;

use CodeIgniter\Model;

class VariantModel extends Model
{
    protected $table         = 'product_variants';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['product_id', 'size', 'color', 'price', 'stock'];

    protected $validationRules = [
        'product_id' => 'required|integer',
        'size'       => 'required|max_length[20]',
        'color'      => 'required|max_length[50]',
        'price'      => 'required|decimal',
        'stock'      => 'required|integer',
    ];

    public function getByProduct(int $productId)
    {
        return $this->where('product_id', $productId)
            ->orderBy('size', 'ASC')
            ->findAll();
    }

    public function decrementStock(int $variantId, int $qty): bool
    {
        $variant = $this->find($variantId);
        if (!$variant || $variant['stock'] < $qty) {
            return false;
        }
        return $this->update($variantId, ['stock' => $variant['stock'] - $qty]);
    }

    public function incrementStock(int $variantId, int $qty): void
    {
        $variant = $this->find($variantId);
        if ($variant) {
            $this->update($variantId, ['stock' => $variant['stock'] + $qty]);
        }
    }
}