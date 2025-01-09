<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{
    public function index()
    {
        $session = new Session();
        $token = $session->get('access_token');
        $guid = $session->get('guid');
        $name = $session->get('name');
        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $token,
            'Content-Type' => "application/json"
        ])->get(env("URL_API", "http://example.com") . '/api/v1/user/self');

        $data = json_decode($response, true);
        return view('profile.index', compact('token', 'session', 'guid', 'name', 'data'));
    }

    public function manipulation()
    {
        $session = new Session();
        $token = $session->get('access_token');
        $id = $session->get('id');
        $name = $session->get('name');
        $response = Http::withHeaders([
            'Authorization' => "Bearer " . $token,
            'Content-Type' => "application/json"
        ])->get(env("URL_API", "http://example.com") . '/api/v1/user/datatable');

        $data = json_decode($response, true);
        return view('profile.manipulation', compact('token', 'session', 'guid', 'name', 'data'));
    }
}
