<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017/3/5
 * Time: 18:37
 */

namespace Common\Validators;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class AuthValidator extends LaravelValidator
{

    /**
     *  [$rules 用户登录规则]
     *  @var [type]
     */
    protected $rules = [
        'adminname' => ['required', 'exists:admins'], //查询用户
        // 'password' => ['required', 'between:6,16'],
    ];
    /**
     *  [$messages 用户登录错误信息]
     *  @var [type]
     */
    protected $messages = [
        'adminname.exists' => '该用户不存在',
        'adminname.unique' => '该用户已存在',
        'adminname.required' => '用户名为必填项',
        'password.required' => '密码为必填项',
        // 'password.between' => '密码长度必须是6-12',
    ];
}
