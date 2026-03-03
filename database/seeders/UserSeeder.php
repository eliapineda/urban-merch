<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'admin', 'email' => 'admin@urbanmerch.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'admin'],
            ['name' => 'juanperez', 'email' => 'juan@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'maria', 'email' => 'maria@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'carlos', 'email' => 'carlos@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'ana', 'email' => 'ana@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'luis', 'email' => 'luis@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'sophia', 'email' => 'sophia@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'david', 'email' => 'david@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'isabella', 'email' => 'isabella@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'jose', 'email' => 'jose@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'laura', 'email' => 'laura@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer'],
            ['name' => 'miguel', 'email' => 'miguel@gmail.com', 'password_hash' => '$2y$10$TvOGt/MzbtjddzUjw5g/.OsR0kQlc7ACiZw8TRHP6xOdCmILufcl2', 'role' => 'customer']
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password_hash'],
                'role' => $user['role'],
            ]);
        }
    }
}
