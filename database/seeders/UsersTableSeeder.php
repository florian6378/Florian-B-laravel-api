<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Supprimer les utilisateurs existants avant d'ajouter de nouveaux utilisateurs
        User::truncate();

        // Ajouter des utilisateurs d'exemple
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin123'),
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@example.com',
                'password' => Hash::make('password123'),
            ],
            // Ajouter plus d'utilisateurs si nécessaire
        ];

        // Insérer les utilisateurs dans la base de données
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
