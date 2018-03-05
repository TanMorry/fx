<?php
/**
 * Created by PhpStorm.
 * User:  惠普
 * Date: 2018/1/11
 * Time: 17:34
 */

namespace api\home\controller;


use cmf\controller\UserBaseController;
use api\common\model\CommonModel;

class WxPayController extends UserBaseController
{

    public function wp(){
        $model = new CommonModel();
        $weixin = $model->is_weixin();
    }
}