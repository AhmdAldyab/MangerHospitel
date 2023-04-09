<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\specialization;

class SpecializationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specializations')->delete();
        $specializations=['surgical','underwear','heart attack','bony','female','children'];

        foreach ($specializations as $specialization) {
            specialization::create(['name'=>$specialization]);
        }
    }
}
