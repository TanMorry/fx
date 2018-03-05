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
namespace app\user\controller;

use think\Db;
use cmf\controller\AdminBaseController;
use think\Validate;
class AdminOrganizationInfoController extends AdminBaseController
{
    //企业网站用户信息列表
    public function index(){
        $user_info = Db::table('feixiu_organization_info')->alias('o')->join('feixiu_identity i','o.identity=i.id','left')->join('feixiu_spell sp','o.contact=sp.id','left')->join('feixiu_scale sc','o.scale=sc.id')->field('o.*,i.name identity_name,sp.start_time,sp.end_time,sc.name scname')->select();
        $this->assign('organization_info',$user_info);
        return $this->fetch();
    }

    //信息编辑
    public function edit(){


        $id = $this->request->param('id', 0, 'intval');
        $result = Db::name('organization_info')->where(['id'=>$id])->find();
//        var_dump($result);die;
        if(!$result){
            $this->error('机构信息不存在');
        }
        $identityList = Db::name('identity')->field('id,name')->where('status=1')->select();
        $contactList = Db::name('spell')->field('id,start_time,end_time')->where('status=1')->select();
        $scaleList = Db::name('scale')->field('id,name')->where('status=1')->select();
        $this->assign('identityList',$identityList);
        $this->assign('contactList',$contactList);
        $this->assign('scaleList',$scaleList);
        $this->assign('organization_info',$result);
        return $this->fetch();
    }

    //信息編輯提交
    public function editPost(){
        $id = $this->request->param('id', 0, 'intval');
        $result = Db::name('organization_info')->where(['id'=>$id])->find();
        if(!$result){
            $this->error('机构单位不存在');
        }
        if($this->request->isPost()){
            $data = $this->request->param();
            $isTrue = $this->validate($data,'AdminOrganizationInfo');
            if($isTrue !== true){
                $this->error($isTrue);
            }else{
//                if (!Validate::is($data['email'], 'email')) {
//                    $this->error("请输入正确的邮箱格式!");
//                }
                if (!preg_match('/(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/', $data['phone'])) {
                    $this->error("请输入正确的手机格式!");
                }
                $data['update_time'] = time();
                if(Db::name('organization_info')->where(['id'=>$id])->update($data) !== false){
                    $this->success("修改成功！",url('AdminOrganizationInfo/index'));
                }else{
                    $this->error("修改失败");
                }
            }
        }
    }

    //信息删除
    public function delete(){
        $id = $this->request->param('id', 0, 'intval');
        $result = Db::name('organization_info')->where(['id'=>$id])->find();
        if(!$result){
            $this->error('机构单位不存在');
        }
        $data = Db::name('organization_info')->delete($id);
        if (!empty($data)) {
            $this->success("删除成功！", url('AdminOrganizationInfo/index'));
        } else {
            $this->error("删除失败！");
        }
    }
}