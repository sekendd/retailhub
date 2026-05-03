<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRetailHubTables extends Migration
{
    public function up()
    {
        // USERS
        $this->forge->addField([
            'id' => ['type'=>'INT','constraint'=>11,'unsigned'=>true,'auto_increment'=>true],
            'name' => ['type'=>'VARCHAR','constraint'=>100],
            'email' => ['type'=>'VARCHAR','constraint'=>100],
            'password' => ['type'=>'VARCHAR','constraint'=>255],
            'role' => ['type'=>'VARCHAR','constraint'=>20],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('users');

        // CATEGORIES
        $this->forge->addField([
            'id' => ['type'=>'INT','auto_increment'=>true],
            'category_name' => ['type'=>'VARCHAR','constraint'=>100],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categories');

        // PRODUCTS
        $this->forge->addField([
            'id' => ['type'=>'INT','auto_increment'=>true],
            'product_name' => ['type'=>'VARCHAR','constraint'=>100],
            'category_id' => ['type'=>'INT'],
            'image' => ['type'=>'VARCHAR','constraint'=>255,'null'=>true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('products');

        // VARIANTS
        $this->forge->addField([
            'id' => ['type'=>'INT','auto_increment'=>true],
            'product_id' => ['type'=>'INT'],
            'size' => ['type'=>'VARCHAR','constraint'=>20],
            'color' => ['type'=>'VARCHAR','constraint'=>50],
            'price' => ['type'=>'DECIMAL','constraint'=>'10,2'],
            'stock' => ['type'=>'INT','default'=>0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('product_variants');
    }

    public function down()
    {
        $this->forge->dropTable('users');
        $this->forge->dropTable('categories');
        $this->forge->dropTable('products');
        $this->forge->dropTable('product_variants');
    }
}