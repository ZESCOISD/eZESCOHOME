<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       User::create( [
       'fname' => 'admin',
       'sname' => 'admin',
       'email' => 'admin@admin.com',
       'staff_number' => '4091',
       'name' =>'admin',
       'email_verified_at' => now(),
       'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
 
        ])->assignRole('admin');
    }
}
