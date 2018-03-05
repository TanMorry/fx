<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 小夏 < 449134904@qq.com>
// +----------------------------------------------------------------------
namespace app\admin\validate;

use think\Validate;

class LeagueValidate extends Validate
{
    protected $rule = [
        'name' => 'require',
        'phone' => 'require|unique:league,phone',
        'provinceid'  => 'require',
        'cityid'  => 'require',
//        'areaid'  => 'require',
    ];

    protected $message = [
        'name.require' => '名称不能为空',
        'phone.require' => '手机号不能为空！',
        'phone.unique'  => '手机号已经存在！',
        'provinceid.require'  => '省份不能为空',
        'cityid.require'  => '城市不能为空',
//        'areaid.require'  => '地区不能为空',
    ];

}