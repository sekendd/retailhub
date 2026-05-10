<?php

namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;

class Products extends BaseController
{
    public function index()
    {
        $model  = new ProductModel();
        $search   = (string) $this->request->getGet('search');

        $products = $search
            ? $model->searchByName($search)
            : $model->getWithCategory();

        return view('products/index', [
            'products' => $products,
            'search'   => $search,
        ]);
    }

    public function create()
    {
        return view('products/create', [
            'categories' => (new CategoryModel())->findAll(),
        ]);
    }

    public function store()
    {
        $model      = new ProductModel();
        $name       = (string) $this->request->getPost('product_name');
        $categoryId = (int) $this->request->getPost('category_id');

        if (!$model->validate(['product_name' => $name, 'category_id' => $categoryId])) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        $model->save(['product_name' => $name, 'category_id' => $categoryId]);

        return redirect()->to('/products');
    }

    public function edit($id)
    {
        return view('products/edit', [
            'product'    => (new ProductModel())->find((int) $id),
            'categories' => (new CategoryModel())->findAll(),
        ]);
    }

    public function update($id)
    {
        $model      = new ProductModel();
        $name       = (string) $this->request->getPost('product_name');
        $categoryId = (int) $this->request->getPost('category_id');

        if (!$model->validate(['product_name' => $name, 'category_id' => $categoryId])) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        $id         = (int) $id;
        $model->update($id, ['product_name' => $name, 'category_id' => $categoryId]);

        return redirect()->to('/products');
    }

    public function delete($id)
    {
        (new ProductModel())->delete((int) $id);
        return redirect()->to('/products');
    }
}
