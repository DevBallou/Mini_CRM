<?php

namespace Database\Seeders;

use App\Models\Societe;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@domain.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ]);

        // Amdin Societe Dadabase Seeder
        Societe::firstOrCreate(['title' => 'Tersea', 'name' => 'Tersea', 'adresse' => 'AbdelMoumen', 'ville' => 'Casablanca', 'pays' => 'Maroc']);
        Societe::firstOrCreate(['title' => 'Média LTD', 'name' => 'Media_LTD', 'adresse' => 'Casablanca-Settat', 'ville' => 'Casablanca', 'pays' => 'Maroc']);

        $role = Role::create(['name' => 'Administrateur']);
        Role::create(['name' => 'Employee']);

        $permissions = Permission::pluck('id','id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
