<?php

namespace App\Controllers;

use App\Models\VariantModel;
use App\Models\ProductModel;

class Variants extends BaseController
{
    public function index($product_id)
    {
        return view('variants/index', [
            'variants' => (new VariantModel())->getByProduct((int) $product_id),
            'product'  => (new ProductModel())->find((int) $product_id),
        ]);
    }

    public function create($product_id)
    {
        return view('variants/create', ['product_id' => (int) $product_id]);
    }

    public function store()
    {
        $model = new VariantModel();
        $data  = $this->request->getPost(['product_id', 'size', 'color', 'price', 'stock']);

        if (!$model->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        $model->save([
            'product_id' => (int) $data['product_id'],
            'size'       => $data['size'],
            'color'      => $data['color'],
            'price'      => (float) $data['price'],
            'stock'      => (int) $data['stock'],
        ]);

        return redirect()->to('/variants/' . (int) $data['product_id']);
    }
}
