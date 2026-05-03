<?php

namespace App\Controllers;

use App\Models\VariantModel;

class Api extends BaseController
{
    public function products()
    {
        $variant = new VariantModel();

        return $this->response->setJSON(
            $variant->findAll()
        );
    }

    public function stock($id)
    {
        $token = $this->request->getHeaderLine('Authorization');

        if ($token != 'Bearer retailhub123') {
            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'error' => 'Unauthorized'
                ]);
        }

        $variant = new VariantModel();
        $item = $variant->find($id);

        return $this->response->setJSON($item);
    }
}