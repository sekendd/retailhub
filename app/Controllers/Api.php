<?php

namespace App\Controllers;

use App\Models\VariantModel;
use App\Models\ProductModel;

class Api extends BaseController
{
    private function auth(): bool
    {
        return $this->request->getHeaderLine('Authorization') === 'Bearer retailhub123';
    }

    // private function unauthorized()
    // {
    //     return $this->response->setStatusCode(401)->setJSON(['error' => 'Unauthorized']);
    // }

    public function products()
    {
        // if (!$this->auth()) return $this->unauthorized();

        $db = \Config\Database::connect();
        $products = $db->table('products p')
            ->select('p.id, p.product_name, p.category_id, p.image')
            ->get()->getResultArray();

        foreach ($products as &$p) {
            $p['image_url'] = $p['image']
                ? base_url('uploads/products/' . $p['image'])
                : null;
        }

        return $this->response->setJSON($products);
    }

    public function product($id)
    {
        if (!$this->auth()) return $this->unauthorized();

        $product = (new ProductModel())->find($id);
        if (!$product) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Product not found']);
        }

        $product['image_url'] = $product['image']
            ? base_url('uploads/products/' . $product['image'])
            : null;

        $product['variants'] = (new VariantModel())
            ->where('product_id', $id)
            ->findAll();

        return $this->response->setJSON($product);
    }

    public function stock($id)
    {
        if (!$this->auth()) return $this->unauthorized();

        $item = (new VariantModel())->find($id);
        if (!$item) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Variant not found']);
        }

        return $this->response->setJSON($item);
    }
}