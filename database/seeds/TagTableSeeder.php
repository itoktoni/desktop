<?php

use App\Dao\Models\Tag;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 20) as $item) {

            $faker = Faker::create();
            $fakers = str_replace(".","",$faker->sentence(2)); 
            Tag::create([
               'tag_code'=>$fakers,
               'tag_name'=>strtoupper(str_replace(" ","_",$fakers)),
            ]);
        }
    }
}
