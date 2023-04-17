<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\MedicineFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table("medicines")->count() > 0
            ?
            $this->command->warn('Medicines table is not empty, therefore NOT seeding!')
            :
            MedicineFactory::new()->count(100)->create();

        DB::table("admins")->count() > 0
            ?
            $this->command->warn('Admins table is not empty, therefore NOT seeding!')
            :
            $this->call(AdminSeeder::class);

        DB::table(\Config::get('countries.table_name'))->count() > 0
            ?
            $this->command->warn('Countries table is not empty, therefore NOT seeding!')
            :
            $this->call(CountriesSeeder::class);

        DB::table("areas")->count() > 0
            ?
            $this->command->warn('Areas table is not empty, therefore NOT seeding!')
            :
//            AreaFactory::new()->count(50)->create();
            $this->call(AreaSeeder::class);
        DB::table("user_addresses")->count() > 0
            ?
            $this->command->warn('Addresses table is not empty, therefore NOT seeding!')
            :
//            AreaFactory::new()->count(50)->create();
            $this->call(UserAddressesSeeder::class);
    }
}
