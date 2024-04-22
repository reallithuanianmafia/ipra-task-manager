<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Azar Guliyev',
                'email' => 'azar@ipra.com',
                'password' => Hash::make('qweqweqwe'),
            ],
            [
                'id' => 2,
                'name' => 'John Doe',
                'email' => 'john@ipra.com',
                'password' => Hash::make('qweqweqwe'),
            ],
            [
                'id' => 3,
                'name' => 'Alice Smith',
                'email' => 'alice@ipra.com',
                'password' => Hash::make('qweqweqwe'),
            ],
            [
                'id' => 4,
                'name' => 'Bob Johnson',
                'email' => 'bob@ipra.com',
                'password' => Hash::make('qweqweqwe'),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
