<?php

namespace App\Controllers;

use App\Models\VariantModel;
use App\Models\ReturnModel;

class Returns extends BaseController
{
    public function index()
    {
        $variant = new VariantModel();
        $data['variants'] = $variant->findAll();

        return view('returns/index', $data);
    }

    public function store()
    {
        $variantModel = new VariantModel();
        $returnModel = new ReturnModel();

        $variant_id = $this->request->getPost('variant_id');
        $qty = $this->request->getPost('qty');
        $reason = $this->request->getPost('reason');

        $item = $variantModel->find($variant_id);

        $returnModel->save([
            'sale_id' => 1,
            'variant_id' => $variant_id,
            'qty' => $qty,
            'reason' => $reason,
            'status' => 'approved'
        ]);

        $variantModel->update($variant_id, [
            'stock' => $item['stock'] + $qty
        ]);

        return redirect()->to('/returns')->with('success', 'Return Completed');
    }
}