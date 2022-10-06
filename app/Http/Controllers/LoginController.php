<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\LoginException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function getView()
    {
        return view('login.login');
    }

    public function authenticate(Request $request)
    {

        try {

            $input = $request->all();

            $validator = Validator::make($input, [
                'username'  => ['required', 'string', 'min:5', 'max:20'],
                'login_pin' => ['required', 'min:4', 'numeric'],
                'password'  => ['required', 'string', 'min:5']
            ]);

            if ($validator->fails()) {
                throw new LoginException("Errores de validación", $validator->errors()->all());
            }

            $preuser = User::where('username', $input['username'])->first();

            if (!isset($preuser) || empty($preuser)) {
                throw new LoginException("Usuario no encontrado", ["El usuario ingresado no existe."]);
            }

            if ($preuser->web_level <= 0) {
                throw new LoginException("Sin permisos", ["El usuario no cuenta con permisos de acceso."]);
            }

            if ($preuser->login_pin != $input['login_pin']) {
                throw new LoginException("Pin incorrecto", ["El pin ingresado no corresponde con el usuario."]);
            }

            if (!auth()->attempt([
                'username' => $input['username'],
                'password' => $input['password']
            ])) {
                throw new LoginException("Credenciales inválidas", ["Usuario y/o contraseña inválidos."]);
            }


            return redirect()->route('web.home');
        } catch (LoginException $ex) {

            return redirect()->route('web.login')->withErrors($ex->getErrors());
        }
    }
}
