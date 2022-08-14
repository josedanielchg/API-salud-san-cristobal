<?php

namespace Database\Seeders;

use App\Models\Symptom;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SymptomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Symptom::insert(array(
            array(
                'name' => 'fiebre', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'erupciones en la piel', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'tos', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'dolores musculares', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'dolor de cabeza', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'vomito', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
        ));

        Symptom::factory(10)->create();

        $symptoms = Symptom::all();


        foreach ($symptoms as $symptom) {
            $random = rand(1, 30);
            $users = [];
            $repeated = false;
            
            for($i=0; $i<$random; $i++) {
                $user_id = User::all()->random()->id;

                while($repeated) {
                    $user_id = User::all()->random()->id;
                    $repeated = in_array($user_id, $users);
                }
                array_push($users, $user_id);
                $symptom->users()->attach($user_id);
            }
        }
    }
}
