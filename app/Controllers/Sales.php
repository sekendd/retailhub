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
        return redirect()->to('/sales');
    }
}