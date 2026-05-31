<?php

namespace App\Controllers;

use App\Models\VariantModel;
use App\Models\SalesModel;

class Sales extends BaseController
{
    public function index()
    {
        $variant = new VariantModel();

        return view('sales/index', [
            'variants' => $variant->findAll()
        ]);
    }

    public function checkout()
    {
        $variantModel = new VariantModel();
        $salesModel   = new SalesModel();

        $variant_id = $this->request->getPost('variant_id');
        $qty        = (int) $this->request->getPost('qty');

        $variant = $variantModel->find($variant_id);

        if (!$variant || $variant['stock'] < $qty) {
            return redirect()->to('/sales')->with('error', 'Insufficient stock or invalid item.');
        }

        // Save sale record
        $salesModel->save([
            'item_variant' => $variant_id,
            'item_quantity' => $qty,
            'created_at'   => date('Y-m-d H:i:s'),
        ]);

        // Deduct stock
        $variantModel->update($variant_id, [
            'stock' => $variant['stock'] - $qty
        ]);

        return redirect()->to('/sales')->with('success', 'Transaction completed.');
    }
}