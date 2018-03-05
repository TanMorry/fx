<?php
/**
 * Created by PhpStorm.
 * User:  惠普
 * Date: 2017/12/18
 * Time: 16:31
 */

namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use app\portal\model\PortalCategoryModel;
use think\Db;

class ScaleController extends AdminBaseController
{
    public function _initialize()
    {

    }

    //规模列表
    public function index()
    {
        $result = Db::name('scale')->select();
        $this->assign('data',$result);
        return $this->fetch();
    }

    //规模添加
    public function add()
    {
        return $this->fetch();
    }

    //规模添加提交
    public function add_post()
    {
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $result = $this->validate($data, 'Scale');

//            $data['user_id'] = cmf_get_current_admin_id();
            $data['create_time'] = time();
            $data['update_time'] = time();
//            var_dump($data);die;
            if ($result !== true) {
                // 验证失败 输出错误信息
                $this->error($result);
            } else {
                $result = Db::name('scale')->insert($data);

                if ($result) {
                    $this->success("添加成功", url("Scale/index"));
                } else {
                    $this->error("添加失败");
                }

            }
        }
    }

    //规模编辑
    public function edit()
    {
        $id = $this->request->param("id", 0, 'intval');
        $data = Db::name('scale')->where(["id" => $id])->find();
//        var_dump($data);die;
        if (!$data) {
            $this->error("该信息不存在！");
        }
        $this->assign("data", $data);
        return $this->fetch();
    }

    //规模编辑提交
    public function edit_post()
    {
        $id = $this->request->param("id", 0, 'intval');
        $data = Db::name('scale')->where(["id" => $id])->find();
//        var_dump($data);die;
        if (!$data) {
            $this->error("该信息不存在！");
        }
        if ($this->request->isPost()) {
            $data   = $this->request->param();
            $result = $this->validate($data, 'Scale');
            if ($result !== true) {
                // 验证失败 输出错误信息
                $this->error($result);

            } else {
                $data['update_time'] = time();
                if (Db::name('scale')->where(["id" => $id])->update($data) !== false) {
                    $this->success("保存成功！", url('Scale/index'));
                } else {
                    $this->error("保存失败！");
                }
            }
        }
    }

    //规模删除
    public function delete()
    {
        $id = $this->request->param("id", 0, 'intval');
        $data = Db::name('scale')->where(["id" => $id])->find();
//        var_dump($data);die;
        if (!$data) {
            $this->error("该信息不存在！");
        }

        $status = Db::name('scale')->delete($id);
        if (!empty($status)) {
            $this->success("删除成功！", url('Scale/index'));
        } else {
            $this->error("删除失败！");
        }
    }

}