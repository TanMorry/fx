<?php

/**
 * Created by PhpStorm.
 * User:  惠普
 * Date: 2017/12/27
 * Time: 9:54
 */
namespace api\home\validate;

use think\Validate;
class IndexValidate extends Validate
{
    protected $rule = [
        'name'  => 'require',
//        'email' => 'require',
        'organization' => 'require',
        'identity' => 'require',
        'contact' => 'require',
        'scale' => 'require',
    ];
    protected $message = [
        'name.require' => '姓名不能为空',
        'phone.require' => '手机号不能为空！',
//        'email.require' => '邮箱不能为空！',
        'organization.require' => '机构单位不能为空！',
        'identity.require' => '身份不能为空！',
        'contact.require' => '联系时间段不能为空！',
        'scale.require' => '规模不能为空！',
    ];
}