<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class TestingController extends Controller
{
    public function index(Request $request)
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');
        $guid = $session->get('guid');

        return view('testing.index', compact('token', 'id', 'name', 'guid', 'session'));
    }
}
