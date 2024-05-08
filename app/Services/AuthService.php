<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AuthRepository;

class AuthService
{
    /**
     * @var AuthRepository
     */
    protected AuthRepository $authRepository;
       /**
     * @param AuthRepository $AuthRepository
     */
    public function __construct(AuthRepository $authRepository)
    {
        $this->authRepository = $authRepository;
    }
    public function register(array $data)
    {
        return $this->authRepository->register($data);
    }
    public function login(array $data)
    {
        return $this->authRepository->login($data);
    }
    public function logout()
    {
        return $this->authRepository->logout();
    }


}
