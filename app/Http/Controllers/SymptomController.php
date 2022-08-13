<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use Illuminate\Http\Request;

class SymptomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $symptom =  Symptom::orderBy('name')->get();

        $response = [
            'message' => 'Sintomas',
            'data' =>  $symptom
        ];

        return response($response, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $fields = $request->validate([
            'name' => 'required|string|unique:symptoms,name',
        ]);

        $symptom = Symptom::create([
            'name' => $fields['name'],
        ]);

        $response = [
            'message' => 'Noticia creada exitosamente',
            'data' => [
                'symptom' => $symptom,
            ]
        ];

        return response($response, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $symptom =  Symptom::find($id);

        $response = [
            'message' => "Noticia - $id",
            'data' =>  $symptom
        ];

        return response($response, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validation
        $fields = $request->validate([
            'name' => 'required|string',
        ]);

        $symptom = Symptom::find($id);

        // Check if symptom exists user
        if(!$symptom) {
            return response([
                'message' => 'Error. Sintoma no encontrada',
            ], 400);
        }

        $symptom->update([
            'name' => $fields['name'],
        ]);

        $response = [
            'message' => 'Sintoma creado exitosamente',
            'data' => [
                'symptom' => $symptom,
            ]
        ];

        return response($response, 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $symptom = Symptom::find($id);
        $symptom->delete();

        $response = [
            'message' => 'Noticia eliminada exitosamente',
        ];

        return response($response, 201);
    }
}
