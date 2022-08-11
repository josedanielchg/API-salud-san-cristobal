<?php

namespace Database\Seeders;

use App\Models\Symptom;
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
            $symptom->users()->attach([
                rand(1, 12),
                rand(13, 24),
                rand(25, 36),
                rand(37, 50),
            ]);
        }

    }
}
