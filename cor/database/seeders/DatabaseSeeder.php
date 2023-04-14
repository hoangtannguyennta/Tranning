<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'id' => 2,
                'name' => 'admin2',
                'email' => 'admin2@gmail.com',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'id' => 3,
                'name' => 'zena',
                'email' => 'zena@gmail.com',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
            [
                'id' => 4,
                'name' => 'zena2',
                'email' => 'zena2@gmail.com',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
                'email_verified_at' => now(),
            ],
        ]);

        DB::table('permissions')->insert([
            ['name' => 'review_post'],
            ['name' => 'create_post'],
            ['name' => 'update_post'],
            ['name' => 'delete_post'],
            ['name' => 'restore_post'],
            ['name' => 'force_delete_post'],
        ]);

        DB::table('roles')->insert([
            ['name' => 'admin'],
        ]);

        DB::table('role_user')->insert([
            [
            'id' => 1,
            'role_id' => 1,
            'user_id' => 1,
            ],
            [
                'id' => 2,
                'role_id' => 1,
                'user_id' => 2,
            ],
        ]);

        DB::table('permission_role')->insert([
            ['role_id' => 1, 'permission_id' => 1],
            ['role_id' => 1, 'permission_id' => 2],
            ['role_id' => 1, 'permission_id' => 3],
            ['role_id' => 1, 'permission_id' => 4],
            ['role_id' => 1, 'permission_id' => 5],
            ['role_id' => 1, 'permission_id' => 6],
        ]);

        DB::table('pubs')->insert([
            [
                'id' => 1,
                'product_name' => 'Huda',
                'amount' => 100,
                'price' => 1000000,
                'user_id' => 1,
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 2,
                'product_name' => 'Coca',
                'amount' => 100,
                'price' => 1000000,
                'user_id' => 2,
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 3,
                'product_name' => 'Lươn',
                'amount' => 100,
                'price' => 1000000,
                'user_id' => 3,
                'author_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => 4,
                'product_name' => 'Gà',
                'amount' => 100,
                'price' => 1000000,
                'user_id' => 4,
                'author_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
