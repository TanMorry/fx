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
namespace app\user\validate;

use think\Validate;

class AdminOrganizationInfoValidate extends Validate
{
    protected $rule = [
        'name' => 'require',
        'phone' => 'require|unique:organization_info,phone',
        'organization' => 'require',
//        'email' => 'require|unique:organization_info,email',
    ];
    protected $message = [
        'name.require' => '姓名不能为空',
        'phone.require' => '手机号不能为空！',
        'phone.unique'  => '手机号已经存在！',
        'organization.require' => '机构单位不能为空',
//        'email.require' => '姓名不能为空',

    ];

}