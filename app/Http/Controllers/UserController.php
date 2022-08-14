<?php

namespace App\Http\Controllers;

use App\Models\Symptom;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
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
        $users =  User::orderBy('name')->get();

        $response = [
            'message' => 'Usuarios',
            'data' =>  $users
        ];

        return response($response, 200);
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function data()
    {
        $users = User::all();
        $symptoms = Symptom::all();

        $users_by_symptoms = array();

        foreach ($symptoms as $symptom) {
            $users_by_symptoms[$symptom->name] = $symptom->users()->count();
        }

        return response([
            'data' => [
                'by_disease' => [
                    'total' => $users->count(),
                    'covid19' => $users->where('disease', 'covid19')->count(),
                    'variante' => $users->where('disease', 'variante')->count(),
                    'viruela' => $users->where('disease', 'viruela')->count(),
                ],
                'by_symptoms' => $users_by_symptoms
            ]
        ], 200);
        
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
            'password' => 'string',
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
            'under_age' => 'nullable|boolean',
            'disease' => [
                'nullable',
                Rule::in(["covid19", "variante", "viruela"])
            ],
            'township_id' => 'exists:App\Models\Township,id',
            'symptoms' => 'array|exists:App\Models\Symptom,id'
        ]);

        // Check if user exists user
        if(!$user) {
            return response([
                'message' => 'Error. Usuario no encontrado',
            ], 400);
        }

        //Check if between request data is defined a new password
        if( isset($fields['password']) ){
            $fields['password'] = bcrypt($fields['password']);
        }

        $user->update($fields);

        $user->symptoms()->sync($fields['symptoms']);

        $response = [
            'message' => 'Usuario actualizado exitosamente',
            'data' => [
                User::with([
                    'notifications' => function($query){ $query->orderBy('seen', 'DESC'); },
                    'symptoms'
                ])->where('id', $user->id)->first()
            ]
        ];

        return response($response, 201);
    }
}
