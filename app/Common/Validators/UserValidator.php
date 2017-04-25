<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 2017/3/31
 * Time: 13:36
 */

namespace Common\Validators;


use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\LaravelValidator;

class UserValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE=>[
//            'user_group_name'=>['required']
        ],
        ValidatorInterface::RULE_UPDATE=>[

        ]
    ];

    protected $messages = [
        'user_group_name.required' => '会员组名称不能为空',
    ];
}