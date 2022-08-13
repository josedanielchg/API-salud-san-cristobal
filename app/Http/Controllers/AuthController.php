<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    /**
     * Register an user in db
     */
    public function register(Request $request)
    {
        //Validation
        $fields = $request->validate([
            'name' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed',
            'phone_home' => 'required|string',
            'phone_mobile' => 'required|string',
            'personal_id' => 'required|numeric|unique:users,personal_id',
            'address_1' => 'required|string',
            'address_2' => 'required|string',
            'hospital' => 'nullable|string',
            'admin' => 'nullable|boolean',
            'under_age' => 'nullable|optional|boolean',
            'disease' => [
                'nullable',
                Rule::in(["covid-19", "variante", "viruela"])
            ],
            'township_id' => 'exists:App\Models\Township,id'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'lastname' => $fields['lastname'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
            'phone_home' => $fields['phone_home'],
            'phone_mobile' => $fields['phone_mobile'],
            'personal_id' => $fields['personal_id'],
            'address_1' => $fields['address_1'],
            'address_2' => $fields['address_2'],
            'hospital' => null,
            'admin' => $fields['admin'],
            'disease' => $fields['disease'],
            'under_age' => $fields['under_age'],
            'township_id' => $fields['township_id']
        ]);

        $response = [
            'message' => 'Usuario registrado exitosamente',
            'data' => [
                'user' => $user,
            ]
        ];

        return response($response, 201);
    }



    /**
     * Login user and returns token
     */
    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check email
        $user = User::where('email', $fields['email'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Error. Usuario y/o contraseña equivocados'
            ], 401);
        }

        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'message' => 'Usuario autenticado exitosamente',
            'token' => $token,
            'data' =>
                User::with([
                    'notifications' => function($query){ $query->orderBy('seen', 'DESC'); },
                    'symptoms'
                ])->where('id', $user->id)->first()
        ];

        return response($response, 201);
    }



    /**
     * Remove access tokens to auth user
     */
    public function logout(Request $request)
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Sesión cerrada'
        ];
    }
}
