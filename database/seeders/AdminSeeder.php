<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try{
            DB::table('admins')->insert([
                'name' => 'root',
                'email' => 'admin@admin.com',
                'password' => bcrypt('123456'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('Admin created successfully.');
        }catch (\Exception $e){
            $this->command->error($e->getMessage());
        }
    }
}
