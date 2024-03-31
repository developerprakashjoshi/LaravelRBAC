<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\{User, Role, Permission};
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            ["name" => "Scott William", "email" => "scott@gmail.com", "password" => bcrypt("password")],
            ["name" => "Kite William", "email" => "kite@gmail.com", "password" => bcrypt("password")],
            ["name" => "Mark William", "email" => "mark@gmail.com", "password" => bcrypt("password")],
        ]);

        Role::insert([
            ["name" => "Editor","slug" => "editor"],
            ["name" => "Author","slug" => "author"],
        ]);

        Permission::insert([
            ["name" => "Add Post","slug" => "add-post"],
            ["name" => "Delete Post","slug" => "delete-post"],
        ]);
    }
}
