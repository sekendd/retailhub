<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    public function index()
    {
        $model = new ProductModel();

         $cache = cache();
         $data = $cache->get('products_data');

        $data = [
            'products' => $model->findAll(),
            'search'   => $this->request->getGet('search')
        ];

        return view('products/index', $data);
            
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
        return view('products/create');
    }

    public function store()
    {
        $model = new ProductModel();
        $image = $this->request->getFile('image');
        $imageName = null;

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/products', $imageName);
        }

        $data = [
            'product_name' => $this->request->getPost('product_name'),
            'category_id'  => $this->request->getPost('category_id'),
            'image'        => $imageName
        ];

        // 1. Remove the dd($data) line so the code actually runs
        // 2. Use the Database Connection directly to bypass Model restrictions
        $db = \Config\Database::connect();
        $db->table('products')->insert($data);

        // 3. Clear the cache that was mentioned in your UI
        cache()->delete('products_data');

        return redirect()->to('/products');
    }

    public function edit($id)
    {
        $model = new ProductModel();
        $data['product'] = $model->find($id);

        if (!$data['product']) {
            return redirect()->to('/products')->with('error', 'Product not found.');
        }

        return view('products/edit', $data);
    }
    

    public function update($id)
    {
        $model = new ProductModel();
        
        // 1. Capture the data exactly as it comes from the form
        $updateData = [
            'product_name' => $this->request->getPost('product_name'),
            'category_id'  => $this->request->getPost('category_id') // This will now carry the decimal
        ];

        // 2. Perform the update
        if ($model->update($id, $updateData)) {
            // 3. IMPORTANT: Clear the cache so the Inventory tab sees the NEW data
            cache()->delete('products_data');
            return redirect()->to('/products')->with('success', 'Product updated successfully');
        } else {
            return redirect()->back()->with('error', 'Update failed');
        }
    }
    public function delete($id)
    {
        $model = new ProductModel();
        $model->delete($id);
        cache()->delete('products_data');

        return redirect()->to('/products');
    }
}