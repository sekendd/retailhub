<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $productModel = new ProductModel();

        $data = [
            'username'       => session()->get('username'),
            'role'           => session()->get('role'),
            'totalProducts'  => $productModel->countAll(),
            'pendingReturns' => 0,
            'salesToday'     => 0,
        ];

        return view('dashboard', $data);
    }
}
?>
