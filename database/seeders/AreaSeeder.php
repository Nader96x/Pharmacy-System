<?php

namespace Database\Seeders;

use App\Models\Area;
use App\Models\Country;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        return;
        $countries = Country::all();

        $areas = [
            [
                'name' => 'Area 1',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Area 2',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Area 3',
                'country_id' => $countries->random()->id,
            ],

            [
                'name' => 'Area 4',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Area 5',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Area 6',
                'country_id' => $countries->random()->id,
            ],
            [
                'name' => 'Area 7',
                'country_id' => $countries->random()->id,
            ],
        ];

        foreach ($areas as $area) {
            Area::create($area);
        }
    }
}
