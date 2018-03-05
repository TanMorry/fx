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

class NavValidate extends Validate
{
    protected $rule = [
        'external_href' => 'require',
        'name'  => 'require',
    ];

    protected $message = [
        'external_href.require'  => '链接地址不能为空',
        'name.require' => '名称不能为空',
    ];

}