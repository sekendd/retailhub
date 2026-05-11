<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        $cache = cache();

        $data = $cache->get('products_data');

        if (!$data) {

            $model = new ProductModel();

            $search = $this->request->getGet('search');

            if ($search) {
                $model->like('product_name', $search);
            }

            $data = [
                'products' => $model->findAll(),
                'search'   => $search
            ];

            $cache->save('products_data', $data, 60);
        }

        return view('products/index', $data);
    }

    public function create()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/');
        }

        return view('products/create');
    }

    public function store()
    {
        $model = new ProductModel();

        $image = $this->request->getFile('image');

        $imageName = '';

        if ($image && $image->isValid() && !$image->hasMoved()) {

            $imageName = $image->getRandomName();

            $image->move(ROOTPATH . 'public/uploads', $imageName);
        }

        $model->save([
            'product_name' => $this->request->getPost('product_name'),
            'category_id'  => $this->request->getPost('category_id'),
            'image'        => $imageName
        ]);

        cache()->delete('products_data');

        return redirect()->to('/products');
    }

    public function edit($id)
    {
        $model = new ProductModel();

        $data['product'] = $model->find($id);

        return view('products/edit', $data);
    }

    public function update($id)
    {
        $model = new ProductModel();

        $model->update($id, [
            'product_name' => $this->request->getPost('product_name'),
            'category_id'  => $this->request->getPost('category_id')
        ]);

        cache()->delete('products_data');

        return redirect()->to('/products');
    }

    public function delete($id)
    {
        $model = new ProductModel();

        $model->delete($id);

        cache()->delete('products_data');

        return redirect()->to('/products');
    }
}