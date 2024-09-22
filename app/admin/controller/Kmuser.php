<?php

namespace app\admin\controller;

use app\admin\AdminBase;
use app\admin\model\Camilouser;
use app\admin\model\Software;
use app\admin\model\Camilo;
use app\admin\model\Card;
use think\facade\Db;

class Kmuser extends AdminBase
{
    /**
     * 卡密用户管理
     * @return \think\response\View
     */
    public function index()
    {
        if (request()->isPost()) {
            $data = input('param.');
            $data = Camilouser::where(['id'=>$data['id']])->find();
            return to_assign(0, '获取成功', $data);
        }else{
            return view();
        }
    }

    /**
     * 返回Json格式的数据
     * @param int $limit
     * @throws \think\db\exception\DbException
     */
    public function datalist($limit=15)
    {
        $list = Camilouser::paginate($limit);
        //$list = Db::name('card')->where('status',1)->order('id', 'desc')->select()->toArray();
        foreach ($list as $key => $value) {
            $rj = Db::name('software')->where(['id'=>$value['pid']])->find();
            $list[$key]['belongs'] = $rj['title'];
        }
        return to_assign(0, '获取成功', $list);
    }

    public function software()
    {
        $list = Software::where(['loginway'=>2])->select();
        return to_assign(0, '获取成功', $list);
    }

    public function post_submit()
    {
        if (request()->isPost()) {
            $param = input('param.');
            if ($param['id'] > 0) {
                if (empty($param['expiration_time'])) {
                    unset($param['expiration_time']);
                }
                $result = Camilouser::update($param, ['id' => $param['id']]);
                if ($result == true) {
                    return to_assign(0, '用户编辑成功');
                } else {
                    return to_assign(1, '用户编辑失败');
                }
            }else{
                if (empty($param['expiration_time'])) {
                    unset($param['expiration_time']);
                }
                $km = Camilo::where(["pid"=>$param['pid'],"camilo"=>$param['camilo'],"status"=>1,"activate"=>0])->find();
                if($km  != null){
                    $kl = Card::where(["id"=>$km['card_id']])->find();
                    if($kl['status'] == 1){
                        $stime = time_calculate($km['duration'],$kl['cardtype']);
                        $data = [
                            "pid" => $param['pid'],
                            "camilo" => $param['camilo'],
                            "expiration_time" => $stime,
                        ];
                        $data1 = [
                            "activate" => 1,
                        ];
                        $result = Camilouser::create($data);
                        $result1 = Camilo::update($data1,["camilo"=>$param['camilo']]);
                        if ($result == true && $result1 == true) {
                            return to_assign(0, '用户添加成功');
                        } else {
                            return to_assign(1, '用户添加失败');
                        }
                    }else{
                        return to_assign(1, '此卡密的卡类已被禁用！');
                    }
                }else{
                    return to_assign(1, '卡密不存在！');
                }
            }
        }
    }

    /**
     * 删除角色
     */
    public function del($id)
    {
        if (request()->isPost()) {
            $data = input('param.');
            if(empty($id)){
                $ids = explode(',', $data['ids']);
            }else{
                $ids = $id;
            }
            $result = Camilouser::destroy($ids);
            if ($result == true) {
                return to_assign(0, '分类删除成功');
            } else {
                return to_assign(1, '分类删除失败');
            }
        }
    }
}