<?php

namespace App\Controllers;

use App\Models\VariantModel;
use App\Models\ReturnModel;

class Returns extends BaseController
{
    public function index()
    {
        return view('returns/index', [
            'variants' => (new VariantModel())->findAll(),
        ]);
    }

    public function store()
    {
        $returnModel  = new ReturnModel();
        $variantModel = new VariantModel();

        $saleId    = (int) $this->request->getPost('sale_id');
        $variantId = (int) $this->request->getPost('variant_id');
        $qty       = (int) $this->request->getPost('qty');

        // Verify the sale belongs to a real sale_item (prevents IDOR)
        $saleItem = db_connect()->table('sale_items')
            ->where('sale_id', $saleId)
            ->where('variant_id', $variantId)
            ->get()->getRowArray();

        if (! $saleItem) {
            return redirect()->back()->with('error', 'Invalid sale reference.');
        }

        $data = [
            'sale_id'    => $saleId,
            'variant_id' => $variantId,
            'qty'        => $qty,
            'reason'     => $this->request->getPost('reason'),
            'status'     => 'pending',
        ];

        if (!$returnModel->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $returnModel->errors());
        }

        $returnModel->save($data);

        return redirect()->to('/returns')->with('success', 'Return submitted for approval.');
    }
}
