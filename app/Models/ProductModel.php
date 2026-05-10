<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table         = 'products';
    protected $primaryKey    = 'id';
    protected $useTimestamps  = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['product_name', 'category_id', 'image'];

    protected $validationRules = [
        'product_name' => 'required|min_length[2]|max_length[100]',
        'category_id'  => 'required|integer',
    ];

    public function getWithCategory()
    {
        return $this->select('products.id, products.product_name, products.image, categories.category_name')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->orderBy('products.id', 'DESC')
            ->findAll();
    }

    public function searchByName(string $keyword)
    {
        return $this->select('products.id, products.product_name, products.image, categories.category_name')
            ->join('categories', 'categories.id = products.category_id', 'left')
            ->like('products.product_name', $keyword)
            ->findAll();
    }
}
