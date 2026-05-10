<?php

namespace App\Controllers;

use App\Models\VariantModel;

class Api extends BaseController
{
    public function products()
    {
        return $this->response->setJSON(
            (new VariantModel())->findAll()
        );
    }

    public function stock($id)
    {
        $item = (new VariantModel())->find((int) $id);

        if (! $item) {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'Not found']);
        }

        return $this->response->setJSON($item);
    }
}
