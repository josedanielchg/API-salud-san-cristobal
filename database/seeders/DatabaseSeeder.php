<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Notification;
use App\Models\Township;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TownshipSeeder::class);

        User::insert([
            'name' => 'User',
            'lastname' => 'Admin',
            'email' => 'user@admin.test',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'phone_home' => '1234567890',
            'phone_mobile' => '1234567890',
            'personal_id' => '12345678',
            'address_1' => 'Avenida Universidad, San Cristobal, Tachira',
            'address_2' => 'Sector Paramillo',
            'admin' => 1,
            'township_id' => Township::all()->where('name', 'San Cristóbal')->first()->id,
            'created_at' => Carbon::now(), 
            'updated_at' => Carbon::now()
        ]);

     
        News::factory(50)->create();
        User::factory(50)->create();

        Notification::factory(500)->create();

        $this->call(SymptomSeeder::class);
    }
}
