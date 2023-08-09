<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;


use App\Models\User;

class AuthService
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function register($data) : void 
    {
        $user = $this->user->store($data);

        auth()->login($user);

    }

}