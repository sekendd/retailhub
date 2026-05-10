<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $table         = 'categories';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['category_name'];

    protected $validationRules = [
        'category_name' => 'required|min_length[2]|max_length[100]',
    ];
}
