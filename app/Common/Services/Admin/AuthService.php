<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017/3/5
 * Time: 8:43
 */

namespace Common\Services\Admin;



use Common\Services\CommonService;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthService extends CommonService
{



    //验证登陆信息
    public function postLogin($request)
    {
        $credentials=[
            'member_list_username'=>$request->get('username'),
            'password'=>$request->get('password'),
        ];
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        } catch (JWTException $e) {

            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token'));
    }

    /*
     * 根据token 获取user信息
     */
    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }

        } catch (TokenExpiredException $e) {

            return response()->json(['token_expired'], $e->getStatusCode());

        } catch (TokenInvalidException $e) {

            return response()->json(['token_invalid'], $e->getStatusCode());

        } catch (JWTException $e) {

            return response()->json(['token_absent'], $e->getStatusCode());

        }
        return response()->json(compact('user'));
    }


}
