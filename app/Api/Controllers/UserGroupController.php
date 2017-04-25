<?php

namespace App\Api\Controllers;


use Common\Services\Admin\UserGroupService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserGroupController extends Controller
{
    /**
     * @var UserGroupService
     */
    private $service;

    public function __construct(UserGroupService $service)
    {
        $this->service = $service;
    }


    /*
     * 会员组列表
     */
    public function index(Request $request)
    {
        return $this->service->getUserGroupList($request);
    }

    public function getAllUserGroup()
    {
        return $this->service->getAllUserGroup();
    }


    /*
     * 会员组添加保存
     */
    public function store(Request $request)
    {
        return $this->service->createOrUpdate($request);
    }

    /*
     * 根据ID 获取会员组信息
     */
    public function show($id)
    {
        return $this->service->findById($id);
    }


   /*
    * 更新会员组
    */
    public function update(Request $request, $id)
    {
        return $this->service->createOrUpdate($request,$id);
    }

    /*
    * 根据ID删除会员组
    */
    public function destroy($id)
    {
        return $this->service->delete($id);
    }
}
