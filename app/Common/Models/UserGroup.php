<?php

namespace Common\Models;

use Illuminate\Database\Eloquent\Model;

class UserGroup extends Model
{
    protected $table='user_groups'; //会员组表
    protected $primaryKey='user_group_id';
    protected $fillable=['user_group_name','user_group_open','user_group_toplimit','user_group_bomlimit','user_group_order'];

    public function getUserGroupOpenAttribute($value)
    {
        switch ($value) {
            case 1:
                return true;
            case 0:
                return false;
        }
    }

    public function setUserGroupOpenAttribute($value)
    {
        switch ($value) {
            case true:
                return $this->attributes['user_group_open']=1;
            case false:
                return $this->attributes['user_group_open']=0;
        }
    }

    public function users()
    {
        return $this->hasMany('Common\Models\User::class','user_group_id','member_list_groupid');
    }

}
