<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use GuzzleHttp\Client;

class SessionController extends Controller
{
    public function setLogin(Request $request)
    {
        $session = new Session();
        $session->set('access_token', $request->access_token);
        $session->set('name', $request->name);
        $session->set('guid', $request->guid);
        $session->set('role', $request->role);

        return response()->json([
            'name' => $request->name,
            'guid' => $request->guid,
            'role' => $request->role,
            'access_token' => $request->access_token,
        ]);
    }

    public function setRegister(Request $request)
    {
        $session = new Session();
        $session->set('guid', $request->guid);

        return $request->guid;
    }

    public function clearSession()
    {
        $session = new Session();
        $session->clear();

        return true;
    }
}
