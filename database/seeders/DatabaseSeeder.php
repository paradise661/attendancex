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
            ['company_logo', Null],
            ['app_logo', Null],
            ['site_information', 'Suspendisse non sem ante. Cras pretium gravida leo a convallis. Nam malesuada interdum metus, sit amet dictum ante congue eu. Maecenas ut maximus enim.'],
            ['map', 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d3532.3793227579026!2d85.3233345!3d27.7055722!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19a4064cbdb5%3A0x48891d457f87b42d!2sNorth%20Easterns%20Education%20Consultancy%20Pvt%20Ltd!5e0!3m2!1sen!2snp!4v1694583346014!5m2!1sen!2snp'],
            ['site_copyright', '2022 All right Reserved'],
            ['site_contact', '9841617710'],
            ['site_email', 'info@arconsultancy.com.np'],
            ['whatsapp', '9841617710'],
            ['site_email2', 'arconsultancy@gmail.com'],
            ['apply_now_link', null],
            ['company_name', 'AR Education Consultancy'],
            ['office_hour', '10 am - 5 pm'],
            ['office_location', 'Putalisadak, Opposite to NMB Bank Limited'],
            ['homepage_about_slogan', 'We Provide Best Quality Education'],
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
