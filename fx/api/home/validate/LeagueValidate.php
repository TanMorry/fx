<?php

/**
 * Created by PhpStorm.
 * User:  惠普
 * Date: 2017/12/27
 * Time: 9:54
 */
namespace api\home\validate;

use think\Validate;
class LeagueValidate extends Validate
{
    protected $rule = [
        'name'  => 'require',
        'provinceid' => 'require',
        'cityid' => 'require',

    ];
    protected $message = [
        'name.require' => '姓名不能为空',
        'phone.require' => '手机号不能为空！',
        'provinceid.require'  => '请选择省份！',
        'cityid.require'  => '请选择城市！',
    ];
}