<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Test extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('equipment_types')->insert([
            'id' => 1,
            'name' => 'router',
            'mask' => 'NAaXa',
        ]);
        DB::table('equipment_types')->insert([
            'id' => 2,
            'name' => 'switch',
            'mask' => 'NAaXZ',
        ]);
        DB::table('equipment_types')->insert([
            'id' => 3,
            'name' => 'repeater',
            'mask' => 'aAaXX',
        ]);



        DB::table('equipment')->insert([
            'equipment_type_id' => 1,
            'serial_number' => '3Ff4b',
            'comment' => 'good',
        ]);
        DB::table('equipment')->insert([
            'equipment_type_id' => 1,
            'serial_number' => '5Kxbh',
            'comment' => 'bad',
        ]);
        DB::table('equipment')->insert([
            'equipment_type_id' => 2,
            'serial_number' => '3Ff4@',
            'comment' => 'good',
        ]);
        DB::table('equipment')->insert([
            'equipment_type_id' => 2,
            'serial_number' => '5Kxbl',
            'comment' => 'bad',
        ]);
        DB::table('equipment')->insert([
            'equipment_type_id' => 3,
            'serial_number' => 'xKx4f',
            'comment' => 'bad',
        ]);
        DB::table('equipment')->insert([
            'equipment_type_id' => 3,
            'serial_number' => 'gFw44',
            'comment' => 'good',
        ]);
    }
}
