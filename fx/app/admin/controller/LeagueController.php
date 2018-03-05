<?php
/**
 * Created by PhpStorm.
 * User:  惠普
 * Date: 2017/12/29
 * Time: 15:44
 */
namespace app\admin\controller;
use cmf\controller\AdminBaseController;
use think\Db;
class LeagueController extends AdminBaseController
{
    public function index(){
        $list = Db::table("feixiu_league l")->join('feixiu_provinces p','l.provinceid=p.provinceid','left')->join('feixiu_cities c','l.cityid=c.cityid','left')->join('feixiu_areas a','l.areaid=a.areaid','left')->field('l.*,p.province,c.city,a.area')->select();
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function edit(){
        $id = $this->request->param('id', 0, 'intval');
        $result = Db::name('league')->where(['id'=>$id])->find();
//        var_dump($result);die;
        if(!$result){
            $this->error('加盟信息不存在');
        }
        $this->assign('list',$result);
        return $this->fetch();
    }

    //加盟信息修改提交
    public function editPost(){
        $id = $this->request->param('id', 0, 'intval');
        $result = Db::name('league')->where(['id'=>$id])->find();
//        var_dump($result);die;
        if(!$result){
            $this->error('加盟信息不存在');
        }
        $data = $this->request->param();
        $validate = $this->validate($data,'League');
        if($validate !== true){
            $this->error($validate);
        }
        if (!preg_match('/(^(13\d|15[^4\D]|17[013678]|18\d)\d{8})$/', $data['phone'])) {
            $this->error("请输入正确的手机格式!");
        }
        $data['update_time'] = time();
        if(Db::name('league')->where(['id'=>$id])->update($data)){
            $this->success("修改成功！", url('League/index'));
        }else{
            $this->error("修改失败");
        }
    }

    /*
     * 加盟信息删除
     */
    public function delete(){
        $id = $this->request->param('id',0,'intval');
        $result = Db::name('league')->where(['id'=>$id])->find();
        if(!$result){
            $this->error('加盟信息不存在');
        }
        $data = Db::name('league')->delete($id);
        if (!empty($data)) {
            $this->success("删除成功！", url('League/index'));
        } else {
            $this->error("删除失败！");
        }
    }
}