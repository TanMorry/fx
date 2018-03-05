<?php
// +----------------------------------------------------------------------
// | ThinkCMF [ WE CAN DO IT MORE SIMPLE ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2017 http://www.thinkcmf.com All rights reserved.
// +----------------------------------------------------------------------
// | Author: Dean <zxxjjforever@163.com>
// +----------------------------------------------------------------------
namespace api\home\controller;

use think\Db;
use think\Validate;
use cmf\controller\RestBaseController;

class IndexController extends RestBaseController
{
    /*
     * 首页导航接口
     */
    public function menu()
    {
        //拿到带有树形结构的导航
        $navMenuModel = new \app\admin\model\NavMenuModel();
        $menus = $navMenuModel->navMenusTreeArray('1', 0, 'id,parent_id,name,href,icon');
//        var_dump($menus);die;
        $this->success('请求成功', $menus);
    }

    public function info_cate()
    {
        $data = [];
        $data['identity'] = Db::name('identity')->field('id,name identity_name')->where('status=1')->select();
        $data['scale'] = Db::name('scale')->field('id,name scale_name')->where('status=1')->select();
        $spell = Db::name('spell')->field('id,start_time,end_time')->where('status=1')->select();
        foreach ($spell as $key=>$val){
            $data['spell'][$key]['id'] = $val['id'];
            $data['spell'][$key]['time'] = date('H:i',$val['start_time']).'-'.date('H:i',$val['end_time']);
        }
        $this->success('请求成功',$data);
    }

    //预约用户信息接口
    public function save()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $result = $this->validate($data, 'Index');
            if ($result !== true) {
                $this->error($result);
            }
            if (!preg_match('/(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/', $data['phone'])) {
                $this->error("请输入正确的手机格式!");
            }
            $validate = new Validate([
                'phone' => 'require|unique:organization_info phone',
            ]);

            $validate->message([
                'phone.unique'  => '手机号已经存在！',
            ]);
            if (!$validate->check($data)) {
                $this->error($validate->getError(),'phone');
            }
            //将官网收集的用户信息存入user_info表
            $data['create_time'] = time();
            $data['update_time'] = time();
            if (Db::name('organization_info')->insert($data)) {
                $this->success("提交成功！");
            } else {
                $this->error("提交失败");
            }
        } else {
            $this->error("请求失败");
        }
    }

    /*
     * 保存加盟申请信息接口
     */
    public function ora_save()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            $result = $this->validate($data, 'League');
            if ($result !== true) {
                $this->error($result);
            }
            if (!preg_match('/(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/', $data['phone'])) {
                $this->error("请输入正确的手机格式!");
            }
            $validate = new Validate([
                'phone' => 'require|unique:organization_info phone',
            ]);

            $validate->message([
                'phone.unique'  => '手机号已经存在！',
            ]);
            if (!$validate->check($data)) {
                $this->error($validate->getError(),'phone');
            }
            if (!Db::name('provinces')->where(['provinceid' => $data['provinceid']])->find()) {
                $this->error("请选择正确的省份");
            }
            if (!Db::name('cities')->where(['cityid' => $data['cityid']])->find()) {
                $this->error("请选择正确的城市");
            }
            //将官网收集的用户信息存入user_info表
            $data['create_time'] = time();
            $data['update_time'] = time();
            if (Db::name('league')->insert($data)) {
                $this->success("提交成功！");
            } else {
                $this->error("提交失败");
            }
        } else {
            $this->error('请求失败');
        }
    }


    /*
     * 省市两级联动接口
     */
    public function get_addr()
    {
        if ($this->request->isGet()) {
            $data = $this->request->param();
            //返回所有省份
            if (!isset($data['province_id'])) {
                $provinceList = Db::name('provinces')->select();
                if ($provinceList) {
                    $this->success('请求成功', $provinceList);
                } else {
                    $this->error('请求失败');
                }
            } else {
                //拿到省id，返回城市列表
                $cityList = Db::name('cities')->where(['provinceid' => intval($data['province_id'])])->select();
                if ($cityList) {
                    $this->success('请求成功', $cityList);
                } else {
                    $this->error('请求失败');
                }
            }
        } else {
            $this->error('请求失败');
        }
    }

    public function reserve()
    {
        if ($this->request->isPost()) {
            $data = $this->request->param();
            if (!preg_match('/(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/', $data['phone'])) {
                $this->error("请输入正确的手机格式!");
            }
            $validate = new Validate([
                'phone' => 'require',
            ]);

            if (!$validate->check($data)) {
                $this->error($validate->getError());
            }
            $data['create_time'] = time();
            if (Db::name('reserve')->data($data)->insert()) {
                $this->success("提交成功！");
            } else {
                $this->error("提交失败");
            }
        } else {
            $this->error('请求失败');
        }
    }
}
