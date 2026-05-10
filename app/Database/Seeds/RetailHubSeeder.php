<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class RetailHubSeeder extends Seeder
{
    public function run()
    {
        // Admin User
        $adminPassword = env('ADMIN_SEED_PASSWORD') ?? throw new \RuntimeException('ADMIN_SEED_PASSWORD is not set in .env');
        $adminEmail    = env('ADMIN_SEED_EMAIL') ?? throw new \RuntimeException('ADMIN_SEED_EMAIL is not set in .env');
        $this->db->table('users')->insert([
            'name'       => 'Administrator',
            'email'      => $adminEmail,
            'password'   => password_hash($adminPassword, PASSWORD_DEFAULT),
            'role'       => 'superadmin',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Categories
        $this->db->table('categories')->insertBatch([
            ['category_name' => 'T-Shirts'],
            ['category_name' => 'Hoodies'],
            ['category_name' => 'Pants'],
            ['category_name' => 'Shoes'],
        ]);

        // Products
        $this->db->table('products')->insertBatch([
            ['product_name' => 'Basic Tee', 'category_id' => 1, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['product_name' => 'Zip Hoodie', 'category_id' => 2, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
            ['product_name' => 'Slim Pants', 'category_id' => 3, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')],
        ]);

        // Product Variants
        $this->db->table('product_variants')->insertBatch([
            ['product_id' => 1, 'size' => 'S', 'color' => 'White', 'price' => 299.00, 'stock' => 50],
            ['product_id' => 1, 'size' => 'M', 'color' => 'Black', 'price' => 299.00, 'stock' => 40],
            ['product_id' => 2, 'size' => 'L', 'color' => 'Gray',  'price' => 799.00, 'stock' => 20],
            ['product_id' => 3, 'size' => '32', 'color' => 'Navy', 'price' => 599.00, 'stock' => 30],
        ]);

        // Sample Sale
        $this->db->table('sales')->insert([
            'invoice_no' => 'INV-0001',
            'user_id'    => 1,
            'total'      => 598.00,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        // Sale Items
        $this->db->table('sale_items')->insertBatch([
            ['sale_id' => 1, 'variant_id' => 1, 'qty' => 2, 'price' => 299.00],
        ]);
    }
}