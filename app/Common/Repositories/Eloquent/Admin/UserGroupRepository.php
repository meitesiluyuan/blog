<?php
namespace Common\Repositories\Eloquent\Admin;

use Common\Models\UserGroup;
use Common\Repositories\Eloquent\Repository;

class UserGroupRepository extends Repository
{
	/**
	 *  [model UserGroup]
	 */
	public function model()
	{
		return UserGroup::class;
	}
	/*
	 *  会员组列表
	 */
	public function getUserGroupList($request)
	{
		$results =$this->model
		   ->where('user_group_name','like','%'.trim($request['name']).'%')
		   ->orderBy("user_group_id",'asc')
		   ->paginate($request['pageSize'])
		   ->toArray();
    	return common_paginate($results);
	}

    public function getAllUserGroup()
    {
        $results =$this->model
            ->orderBy("user_group_id",'asc')
            ->get();
        return $results;
	}


}
