<?php
namespace Common\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table='users'; //会员表
    protected $primaryKey='member_list_id';

    protected $fillable = [
        'member_list_username', 'member_list_salt', 'member_list_groupid','member_list_nickname',
        'member_list_province','member_list_city','member_list_town','member_list_sex','member_list_headpic',
        'member_list_tel','member_list_email','member_list_from','user_url','birthday','signature','last_login_ip',
        'last_login_time','user_activation_key','user_status','score','coin','member_list_pwd',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'member_list_pwd', 'remember_token',
    ];

    //性别修改器
    public function getMemberListSexAttribute($value)
    {
        switch ($value) {
            case 1:
                return '男';
            case 2:
                return '女';
            case 3:
                return '保密';
        }
    }

    public function setMemberListSexAttribute($attribute)
    {
        switch ($attribute) {
            case '男':
                $this->attributes['member_list_sex']=1;
                break;
            case '女':
                $this->attributes['member_list_sex']=2;
                break;
            case '保密':
                $this->attributes['member_list_sex']=3;
                break;
        }
    }

    //状态修改器
    public function getUserStatusAttribute($value)
    {
        switch ($value) {
            case 0:
                return false;
            case 1:
                return true;
        }
    }

    public function setUserStatusAttribute($attribute)
    {
        switch ($attribute) {
            case true:
                 $this->attributes['user_status']=1;
                 break;
            case false:
                 $this->attributes['user_status']=0;
                 break;
        }
    }

    //激活状态修改器
    public function getUserActivationKeyAttribute($value)
    {
        switch ($value) {
            case 0:
                return false;
            case 1:
                return true;
        }
    }

    public function setUserActivationKeyAttribute($attribute)
    {
        switch ($attribute) {
            case true:
                $this->attributes['user_activation_key']=1;
                break;
            case false:
                $this->attributes['user_activation_key']=0;
                break;
        }
    }


    //设置jwt 自定义密码字段
    public function getAuthPassword()
    {
        return $this->member_list_pwd;
    }

    //会员所属的会员组
    public function userGroup()
    {
       return $this->belongsTo('Common\Models\UserGroup','member_list_groupid','user_group_id');
    }


}
