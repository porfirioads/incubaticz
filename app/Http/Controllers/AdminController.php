<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Validator;

class AdminController extends Controller
{
    private function jsonResponse($code, $params)
    {
        $jsonResponse = response()->json($params);
        $jsonResponse->setStatusCode($code);
        return $jsonResponse;
    }

    public function showLoginForm(Request $request)
    {
        return View::make('login');
    }

    public function login(Request $request)
    {
        $rules = [
            'username' => ['required'],
            'password' => ['required']
        ];

        $messages = [
            'username.required' => 'El nombre de usuario es requerido',
            'password.required' => 'La contraseña es requerida'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            Session::set('adminLogged', false);
            return $this->jsonResponse(400, [
                'errors' => $validator->errors()->all()
            ]);
        }

        if ($request['username'] == 'admin' && $request['password'] == 'admin') {
            Session::set('adminLogged', true);
            return $this->jsonResponse(200, [
                'message' => 'Usuario loggeado correctamente'
            ]);
        } else {
            Session::set('adminLogged', false);
            return $this->jsonResponse(400, [
                'errors' => ['Usuario o contraseña incorrectos']
            ]);
        }
    }

    public function logout(Request $request)
    {
        Session::set('adminLogged', null);
        return redirect('/');
    }
}
