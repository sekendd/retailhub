<?php

namespace App\Controllers;

use App\Models\VariantModel;
use App\Models\SalesModel;

class Sales extends BaseController
{
    public function index()
    {
        return view('sales/index', [
            'variants' => (new VariantModel())->findAll(),
        ]);
    }

    public function checkout()
    {
        $variantModel = new VariantModel();
        $salesModel   = new SalesModel();

        $variantId = (int) $this->request->getPost('variant_id');
        $qty       = (int) $this->request->getPost('qty');

        if ($qty <= 0) {
            return redirect()->back()->with('error', 'Invalid quantity.');
        }

        if (!$variantModel->decrementStock($variantId, $qty)) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        $variant    = $variantModel->find($variantId);
        $total      = $variant['price'] * $qty;
        $invoiceNo  = $salesModel->generateInvoiceNo();

        $salesModel->save([
            'invoice_no' => $invoiceNo,
            'user_id'    => session()->get('id'),
            'total'      => $total,
        ]);

        $saleId = $salesModel->getInsertID();
        db_connect()->table('sale_items')->insert([
            'sale_id'    => $saleId,
            'variant_id' => $variantId,
            'qty'        => $qty,
            'price'      => $variant['price'],
        ]);

        return redirect()->to('/sales')->with('success', 'Sale recorded: ' . esc($invoiceNo));
    }
}