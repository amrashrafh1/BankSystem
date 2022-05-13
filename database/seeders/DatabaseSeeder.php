<?php

namespace Database\Seeders;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // prizes factory
        /* Prize::factory(100)->create();
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@app.com',
            'password' => bcrypt('password'),
            'points' => 100,
        ]);
        User::create([
            'name' => 'Amr',
            'email' => 'amr@app.com',
            'password' => bcrypt('password'),
            'points' => 100,
        ]);

        $role = Role::create(['name' => 'admin']);
        $admin->assignRole($role);
        $admin->save();
        $prize = Prize::first();
        $prize->users()->attach($admin); */
        
        Transaction::factory(8)->create();
    }
}
