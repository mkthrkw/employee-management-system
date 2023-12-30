<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            BcRouteSeeder::class,
            AccountSeeder::class,
            DepartmentSeeder::class,
            DesktopPcSeeder::class,
            LaptopPcSeeder::class,
            MailingListSeeder::class,
            MobilePhoneSeeder::class,
            AccountBcRouteSeeder::class,
            AccountDepartmentSeeder::class,
            AccountMailingListSeeder::class,
        ]);
    }
}
