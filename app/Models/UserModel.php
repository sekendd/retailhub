<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table         = 'users';
    protected $primaryKey    = 'id';
    protected $useTimestamps = true;
    protected $useSoftDeletes = true;
    protected $allowedFields = ['name', 'email', 'password', 'role'];
    protected $hiddenFields  = ['password'];

    protected $validationRules = [
        'name'      => 'required|min_length[2]|max_length[100]',
        'email'     => 'required|valid_email|is_unique[users.email,id,{id}]',
        'user_pass' => 'required|min_length[8]',
        'role'      => 'required|in_list[superadmin,admin,staff]',
    ];

    protected $validationMessages = [
        'user_pass' => [
            'required'   => 'Password is required.',
            'min_length' => 'Password must be at least 8 characters.',
        ],
    ];
}
