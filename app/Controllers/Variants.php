<?php

namespace App\Controllers;

use App\Models\VariantModel;
use App\Models\ProductModel;

class Variants extends BaseController
{
    public function index($product_id)
    {
        if (!session()->get('logged_in')) return redirect()->to('/');

        $variant = new VariantModel();
        $product = new ProductModel();

        $data['variants'] = $variant->where('product_id', $product_id)->findAll();
        $data['product'] = $product->find($product_id);

        return view('variants/index', $data);
    }

    public function create($product_id)
    {
        $data['product_id'] = $product_id;
        return view('variants/create', $data);
    }

    public function store()
    {
        $variant = new VariantModel();

        $variant->save([
            'product_id' => $this->request->getPost('product_id'),
            'size' => $this->request->getPost('size'),
            'color' => $this->request->getPost('color'),
            'price' => $this->request->getPost('price'),
            'stock' => $this->request->getPost('stock')
        ]);

        return redirect()->to('/variants/' . $this->request->getPost('product_id'));
    }
    public function delete($id, $product_id)
{
    $variant = new VariantModel();
    $variant->delete($id);

    return redirect()->to('/variants/' . $product_id);
}
// app/Controllers/Variants.php

public function edit($id)
{
    $variantModel = new VariantModel();
    $data['variant'] = $variantModel->find($id);
    
    return view('variants/edit', $data);
}

public function update()
{
    $variantModel = new VariantModel();
    $id = $this->request->getPost('id');
    $productId = $this->request->getPost('product_id');

    $variantModel->update($id, [
        'size'  => $this->request->getPost('size'),
        'color' => $this->request->getPost('color'),
        'price' => $this->request->getPost('price'),
        'stock' => $this->request->getPost('stock')
    ]);

    return redirect()->to('/variants/' . $productId);
}
}
