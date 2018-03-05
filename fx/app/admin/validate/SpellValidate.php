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

class SpellValidate extends Validate
{
    protected $rule = [
        'start_time' => 'require',
        'end_time' => 'require',
    ];
    protected $message = [
        'start_time.require' => '请选择开始时间！',
        'end_time.require' => '请选择结束时间！',
    ];

}