<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddSoftDeleteAndForeignKeys extends Migration
{
    public function up()
    {
        // Add deleted_at to users (soft-delete)
        $this->forge->addColumn('users', [
            'deleted_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'updated_at'],
        ]);

        // Change role from VARCHAR to ENUM
        $this->forge->modifyColumn('users', [
            'role' => ['type' => 'ENUM', 'constraint' => ['superadmin', 'admin', 'staff'], 'default' => 'staff'],
        ]);

        // Add deleted_at to products (soft-delete)
        $this->forge->addColumn('products', [
            'deleted_at' => ['type' => 'DATETIME', 'null' => true, 'after' => 'updated_at'],
        ]);

        // Make stock unsigned on product_variants
        $this->forge->modifyColumn('product_variants', [
            'stock' => ['type' => 'INT', 'unsigned' => true, 'default' => 0],
        ]);

        // Unique invoice_no on sales
        $this->db->query('ALTER TABLE `sales` ADD UNIQUE KEY `invoice_no` (`invoice_no`)');

        // Foreign keys — only add if not already present
        $this->db->query('ALTER TABLE `products`
            ADD CONSTRAINT `fk_products_category`
            FOREIGN KEY (`category_id`) REFERENCES `categories`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT');

        $this->db->query('ALTER TABLE `product_variants`
            ADD CONSTRAINT `fk_variants_product`
            FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE CASCADE ON UPDATE CASCADE');

        $this->db->query('ALTER TABLE `sales`
            ADD CONSTRAINT `fk_sales_user`
            FOREIGN KEY (`user_id`) REFERENCES `users`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT');

        $this->db->query('ALTER TABLE `sale_items`
            ADD CONSTRAINT `fk_sale_items_sale`
            FOREIGN KEY (`sale_id`) REFERENCES `sales`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT `fk_sale_items_variant`
            FOREIGN KEY (`variant_id`) REFERENCES `product_variants`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT');

        $this->db->query('ALTER TABLE `returns`
            ADD CONSTRAINT `fk_returns_sale`
            FOREIGN KEY (`sale_id`) REFERENCES `sales`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
            ADD CONSTRAINT `fk_returns_variant`
            FOREIGN KEY (`variant_id`) REFERENCES `product_variants`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT');
    }

    public function down()
    {
        $this->db->query('ALTER TABLE `returns` DROP FOREIGN KEY `fk_returns_sale`, DROP FOREIGN KEY `fk_returns_variant`');
        $this->db->query('ALTER TABLE `sale_items` DROP FOREIGN KEY `fk_sale_items_sale`, DROP FOREIGN KEY `fk_sale_items_variant`');
        $this->db->query('ALTER TABLE `sales` DROP FOREIGN KEY `fk_sales_user`, DROP INDEX `invoice_no`');
        $this->db->query('ALTER TABLE `product_variants` DROP FOREIGN KEY `fk_variants_product`');
        $this->db->query('ALTER TABLE `products` DROP FOREIGN KEY `fk_products_category`');

        $this->forge->dropColumn('products', 'deleted_at');
        $this->forge->modifyColumn('users', [
            'role' => ['type' => 'VARCHAR', 'constraint' => 20],
        ]);
        $this->forge->dropColumn('users', 'deleted_at');
    }
}
