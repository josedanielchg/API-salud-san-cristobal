<?php

namespace Database\Seeders;

use App\Models\Township;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TownshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Township::insert(array(
            array(
                'name' => 'Andrés Bello', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Antonio Rómulo Costa', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Ayacucho', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Bolívar', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Cardenas', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Cordoba', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Fernández Feo', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Francisco de Miranda', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'García de Hevia', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Guasimos', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Independenci', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Jauregui', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'José María Vargas', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Junin', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Libertad', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Libertador', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Lobatera', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Michelena', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Panamericano', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Pedro María Ureña', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Rafael Urdaneta', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Samuel Darío Maldonado', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'San Cristóbal', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Seboruco', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Simón Rodríguez', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Sucre', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Torbes', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'Uribante', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
            array(
                'name' => 'San Judas Tadeo', 
                'created_at' => Carbon::now(), 
                'updated_at' => Carbon::now()
            ),
        ));
    }
}
