<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\DB;

class UserController extends Controller {

    public function login_app(Request $request) {
        try {
            $auth = false;
            //verificando usuário com mesmo e-mail
            $users = (array) DB::table('users')->where('email', $request->input("email"))->get();
            $users = (array) $users[0];
            //pegando seu código
            $codUser = $users["id"];

//            $auth = Auth::attempt(array('email' => $request->input("email"), 'password' => $request->input("password")));
            //usando código para pegar resto de dados 
            $usuario = Auth::loginUsingId($codUser);
            if ($usuario->email == $request->input("email") && $usuario->psw2 == md5($request->input("password"))) {
                $auth = true;
                session(['email' => $usuario->email]);
            }
            if ($request->ajax()) {
                Session::flush();
                return response()->json([
                            'situacao' => $auth,
                            'intended' => URL::previous()
                ]);
            } else {
                return redirect()->intended(URL::route('/home'));
            }
            return redirect(URL::route('/login'));
        } catch (Exception $ex) {
            die($ex);
        }
    }

}
