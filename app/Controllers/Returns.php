<?php

namespace App\Controllers;

use App\Models\VariantModel;

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
        return redirect()->to('/returns');
    }
}