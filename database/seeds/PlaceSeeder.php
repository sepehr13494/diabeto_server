<?php

use Illuminate\Database\Seeder;

class PlaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        $faker2 = new Ybazli\Faker\Faker();
        //
        for ($i = 0 ; $i<1000 ; $i++){
            $s = $faker->numberBetween(0,16);
            $e = $faker->numberBetween($s,24);
            DB::table('places')->insert([
                'category' => $faker->numberBetween(1,4),
                'name' => $faker2->firstName(),
                'address'=>$faker2->address(),
                'lat'=>$faker->randomFloat(7,35.5712165,35.776984),
                'long'=>$faker->randomFloat(7,51.123156,51.630498),
                'startTime'=>$s,
                'endTime'=>$e,
                'workDays'=>json_encode($faker->randomElements([1,2,3,4,5,6,7],$faker->numberBetween(1,7),false)),
                'icons'=>'icons-json'
            ]);
        }
    }
}
