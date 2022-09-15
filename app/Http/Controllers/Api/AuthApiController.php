<?php

namespace App\Http\Controllers\Api;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthApiController extends Controller
{

    /**
     * Devuelve un token para acceder a las rutas
     * privadas.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => ['required', 'string', 'min:5', 'max:20'],
            'password' => ['required', 'string', 'min:5', 'max:20']
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }

        if (!auth()->attempt($input)) {
            return response()->json(['error' => 'Credenciales inválidas.'], 401);
        }

        $token = auth()->user()->createToken('authToken')->accessToken;

        return response()->json([
            'message' => 'Token generado con éxito.',
            'user' => auth()->user(),
            'access_token' => $token
        ]);
    }
}
