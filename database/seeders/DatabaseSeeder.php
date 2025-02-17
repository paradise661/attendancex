<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $items = [
            ['company_name', 'Paradise infotech'],
            ['company_logo', Null],
            ['app_logo', Null],
            ['company_information', 'We always wanted to be recognized as a global brand so, we based our headquarter at Germany'],
            ['phone', '9800000000'],
            ['smtp_email', 'durgesh.upadhyaya7@gmail.com'],
            ['email', 'info@attendancex.com']
        ];

        if (count($items)) {
            foreach ($items as $item) {
                \App\Models\Setting::create([
                    'key' => $item[0],
                    'value' => $item[1],
                ]);
            }
        }

        User::create([
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'email' => 'admin@attendancex.com',
            'password' => Hash::make('password'),
            'user_type' => 'Admin',
        ]);
    }
}
