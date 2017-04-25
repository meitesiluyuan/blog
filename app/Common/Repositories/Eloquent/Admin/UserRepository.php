<?php
namespace Common\Repositories\Eloquent\Admin;

use Common\Repositories\Eloquent\Repository;
use Common\Models\User;

class UserRepository extends Repository
{
	/**
	 *  [model User]
	 */
	public function model()
	{
		return User::class;
	}
	/**
	 *  [getUserList 管理员列表]
	 */
	public function getUserList($request)
	{

		$results =$this->model
            ->with(['userGroup'=>function($query){
                $query->select('user_group_id','user_group_name');
            }])
		   ->where('member_list_username','like','%'.trim($request['keyword']).'%')

		   ->orderBy("member_list_id",'asc')
		   ->paginate($request['pageSize'])
		   ->toArray();

    	return common_paginate($results);
	}

    /**
     * 根据ID获取会员信息
     * @param $id 会员ID
     * @return mixed
     */
    public function getUser($id)
    {
        $user=$this->model
            ->with(['userGroup'=>function($query){
                $query->select('user_group_id','user_group_name');
            }])
            ->where('member_list_id',$id)
            ->get();
        return $user;
	}

}
