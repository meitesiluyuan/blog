<?php

namespace App\Api\Controllers;


use Common\Services\Admin\UserService;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends BaseController
{

    private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }


    /*
     * 用户头像更改
     */
    public function avatar(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $file=$request->file('avatar');
        $fileName=md5(time().$user->id).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('avatar'),$fileName);
        $user->member_list_headpic=asset('avatar/'.$fileName);
        $user->save();

        return response()->json(['src'=>$user->member_list_headpic,'name'=>$user->member_list_username,'errorcode'=>0]);

    }

    /*
     * 会员列表
     */
    public function index(Request $request)
    {

        return $this->service->getUserList($request);
    }


    /*
     * 会员添加保存
     */
    public function store(Request $request)
    {
        return $this->service->createOrUpdate($request);
    }

    /*
     * 根据ID 获取会员信息
     */
    public function show($id)
    {

        return $this->service->findById($id);
    }


    /*
     * 更新会员
     */
    public function update(Request $request, $id)
    {
        return $this->service->createOrUpdate($request,$id);
    }

    /*
    * 根据ID删除会员
    */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
