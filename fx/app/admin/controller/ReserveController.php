<?php
/**
 * Created by PhpStorm.
 * User:  惠普
 * Date: 2018/1/19
 * Time: 17:58
 */

namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;

class ReserveController extends AdminBaseController
{
    public function index()
    {
        $list = Db::name('reserve')->select();
        $this->assign('data',$list);
        return $this->fetch();
    }
}