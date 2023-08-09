<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    private $auth_service;
    public function __construct(AuthService $auth_service) 
    {
        $this->auth_service = $auth_service;
    }
    /**
     * Display register page.
     * 
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('auth.register');
    }

    /**
     * Handle account registration request
     * 
     * @param RegisterRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request) 
    {
        $this->auth_service->register($request->validated());

        return redirect('/')->with('success', "Account successfully registered.");
    }
}
