<?php

namespace App\Api\Controllers;

use Common\Services\Admin\AuthService;
use Illuminate\Http\Request;


class AuthController extends BaseController
{
    /**
     * @var AuthService
     */
    private $service;

    public function __construct(AuthService $service)
    {
        $this->service = $service;
    }

    /*
     * 登录验证
     */
    public function login(Request $request)
    {
        return $this->service->postLogin($request);
    }

    public function userInfo()
    {
        return $this->service->getAuthenticatedUser();
    }


    public function register(Request $request)
    {

    }
}
