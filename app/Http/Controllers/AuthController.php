<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth:api', ['except' => ['index', 'login', 'register', 'verify', 'chooseVerify']]);
    // }

    public function index()
    {
        return view('auth.login');
    }
    public function confirmation()
    {
        return view('auth.confirmation');
    }
    public function register()
    {
        return view('auth.register');
    }
    public function chooseVerify()
    {
        $session = new Session();
        $guid = $session->get('guid');
        return view('auth.choose-verify', compact('guid'));
    }
    public function verify()
    {
        return view('auth.verify');
    }
    public function resendOtp()
    {
        $session = new Session();
        $guid = $session->get('guid');
        $response = Http::withHeaders([
            'Content-Type' => "application/json"
        ])->post(env("URL_API", "http://example.com") . '/api/v1/send-otp', [
            'guid' => $guid
        ]);
        return view('auth.verify');
    }
    public function checkOtp($guid, $otp)
    {
        $response = Http::withHeaders([
            'Content-Type' => "application/json"
        ])->post(env("URL_API", "http://example.com") . '/api/v1/check-otp', [
            'guid' => $guid,
            'otp' => $otp
        ]);
        if ($response->successful()) {
            return view('auth.login');
        }
    }
}
