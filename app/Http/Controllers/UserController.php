<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user) 
    {
        //Validation
        $fields = $request->validate([
            'name' => 'string',
            'lastname' => 'string',
            'email' => [
                'email',
                Rule::unique('users')->ignore($user->id)          
            ],
            'password' => 'string|confirmed',
            'phone_home' => 'string',
            'phone_mobile' => 'string',
            'personal_id' => [
                'numeric',
                Rule::unique('users')->ignore($user->id)          
            ],
            'address_1' => 'string',
            'address_2' => 'string',
            'hospital' => 'nullable|string',
            'admin' => 'nullable|boolean',
            'disease' => [
                'nullable',
                Rule::in(["covid-19", "variante", "viruela"])
            ],
            'township_id' => 'exists:App\Models\Township,id',
            'symptoms' => 'array|exists:App\Models\Symptom,id'
        ]);

        $user->update($fields);

        $user->symptoms()->sync($fields['symptoms']);

        $response = [
            'message' => 'Usuario actualizado exitosamente',
            'data' => [
                'user' => $user,
                'symptoms' => $user->symptoms
            ]
        ];

        return response($response, 201);
    }
}
