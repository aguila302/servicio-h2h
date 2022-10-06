<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    /**
     * Registra un nuevo usuario en la base de datos.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name'              => ['required', 'min:5', 'max:100'],
            'last_name'         => ['required', 'max:100'],
            'second_last_name'  => ['required', 'max:100'],
            'username'          => ['required', 'unique:users', 'min:5', 'max:20'],
            'email'             => ['required', 'unique:users', 'email'],
            'phone'             => ['required', 'min:10'],
            'password'          => ['required', 'min:5', 'max:20']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->all()], 400);
        }

        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);

        return response()->json($user);
    }
}
