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
            'under_age' => 'nullable|boolean',
            'disease' => [
                'nullable',
                Rule::in(["covid19", "variante", "viruela"])
            ],
            'township_id' => 'exists:App\Models\Township,id'
        ]);

        $fields['password'] = bcrypt($fields['password']);

        $user = User::create($fields);

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
