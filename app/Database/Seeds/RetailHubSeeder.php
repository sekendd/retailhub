<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RetailHubSeeder extends Seeder
{
    public function run()
    {
        // Admin User
        $this->db->table('users')->insert([
            'name'     => 'Administrator',
            'email'    => 'admin@gmail.com',
            'password' => password_hash('admin123', PASSWORD_DEFAULT),
            'role'     => 'superadmin'
        ]);

        // Categories
        $this->db->table('categories')->insertBatch([
            ['category_name' => 'T-Shirts'],
            ['category_name' => 'Hoodies'],
            ['category_name' => 'Pants'],
            ['category_name' => 'Shoes']
        ]);
    }
}