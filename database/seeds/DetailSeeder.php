<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(\Faker\Generator $faker)
    {
        //
        $faker2 = new Ybazli\Faker\Faker();
        //
        for ($i = 0 ; $i<1000 ; $i++){
            if (fmod($i,3) == 0 && $i != 0){
                $image2 = $faker->imageUrl();
            }else{
                $image2 = "";
            }
            DB::table('details')->insert([
                'place_id'=>$i+1,
                'description' => $faker2->paragraph(),
                'detailIcons' => Str::random(10),
                'phoneNumber' => $faker2->mobile(),
                'image1' => $faker-> imageUrl() ,
                'image2' => $image2 ,
                ]);
        }
    }
}
