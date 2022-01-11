<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Test;
class LabTest extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $test = [[
            't_name' => 'Blood Group',
            't_price' => '200',
            'status' => '1',
        ],
        [
            't_name' => 'RCB',
            't_price' => '300',
            'status' => '1',
        ],
        [
            't_name' => 'Thelisma',
            't_price' => '400',
            'status' => '1',
        ],
        [
            't_name' => 'Tumor',
            't_price' => '500',
            'status' => '1',
        ]];

        Test::insert($test);
    
    }
}
