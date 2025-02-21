<?php

namespace Database\Seeders;

use App\Models\MasterProperty\Measurement;
use Illuminate\Database\Seeder;

class MeasurementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Measurement::truncate();
        
        $measurements = [
            [
                'name' => 'SqFt',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'SqYd',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'SqM',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Acre',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Bigha',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Biswa',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Biswa Kacha',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Cent',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Chatak',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Decimal',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Dhur',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Gaj',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Ground',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Kanal',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Katha',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Killa',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Lessa',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Marla',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Murabba',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Pura',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Sq. Km',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Sq. Karam',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Sq. Mile',
                'type' => Measurement::MEASUREMENT_TYPE['area'],
            ],
            [
                'name' => 'Ft.',
                'type' => Measurement::MEASUREMENT_TYPE['height'],
            ],
            [
                'name' => 'Mt.',
                'type' => Measurement::MEASUREMENT_TYPE['height'],
            ],
        ];

        Measurement::insert($measurements);   
    }
}
