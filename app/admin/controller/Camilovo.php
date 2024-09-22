<?php

namespace app\admin\controller;

use app\admin\AdminBase;
use app\admin\model\Camilo;
use app\admin\model\Card;
use app\admin\model\Software;
use think\facade\Db;

class Camilovo extends AdminBase
{
    /**
     * 卡类管理
     * @return \think\response\View
     */
    public function index()
    {
        if (request()->isPost()) {
            $data = input('param.');
            $data = Camilo::where(['id'=>$data['id']])->find();
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
        $list = Camilo::order('id', 'desc')->paginate($limit);
        //$list = Db::name('card')->where('status',1)->order('id', 'desc')->select()->toArray();
        foreach ($list as $key => $value) {
            $rj = Db::name('software')->where(['id'=>$value['pid']])->find();
            $list[$key]['belongs'] = $rj['title'];
            $kl = Db::name('card')->where(['id'=>$value['card_id'],"pid"=>$value['pid']])->find();
            if($kl['cardtype'] == '1'){
                $list[$key]['cardtype'] = '小时卡';
            }elseif ($kl['cardtype'] == '2') {
                $list[$key]['cardtype'] = '周卡';
            }elseif ($kl['cardtype'] == '3') {
                $list[$key]['cardtype'] = '月卡';
            }elseif ($kl['cardtype'] == '4') {
                $list[$key]['cardtype'] = '年卡';
            }elseif ($kl['cardtype'] == '5') {
                $list[$key]['cardtype'] = '终身卡';
            }
        }
        return to_assign(0, '获取成功', $list);
    }

    public function software()
    {
        $list = Software::select();
        return to_assign(0, '获取成功', $list);
    }

    public function cardtware()
    {
        $param = input('param.');
        if($param['pid'] != ''){
            $list = Card::where(['pid'=>$param['pid']])->select();

        }else{
            $list = Card::select();
        }
        foreach ($list as $key => $value) {
            if($value['cardtype'] == '1'){
                $list[$key]['title'] = '小时卡';
            }elseif ($value['cardtype'] == '2') {
                $list[$key]['title'] = '周卡';
            }elseif ($value['cardtype'] == '3') {
                $list[$key]['title'] = '月卡';
            }elseif ($value['cardtype'] == '4') {
                $list[$key]['title'] = '年卡';
            }elseif ($value['cardtype'] == '5') {
                $list[$key]['title'] = '终身卡';
            }
        }
        return to_assign(0, '获取成功', $list);
    }

    public function post_submit()
    {
        if (request()->isPost()) {
            $param = input('param.');
            if ($param['id'] > 0) {

                $result = Camilo::update($param, ['id' => $param['id']]);
                if ($result == true) {
                    return to_assign(0, '卡类编辑成功');
                } else {
                    return to_assign(1, '卡类编辑失败');
                }
            }else{
                $shuliang = intval($param['number']);
                $kmfle = 'km/'.time().'.txt';
                if(!file_exists('km')){
                    mkdir('km',0777,true);
                }
                if(!file_exists($kmfle)){
                    if($myfile=fopen($kmfle,'w')){
                        for ($x=1; $x<=$shuliang; $x++) {
                            $km = $param['dop'].set_salt((int)$param['changdus']);
                            $data = [
                                "pid" => $param['pid'],
                                "card_id" => $param['card_id'],
                                "dop" => $param['dop'],
                                "duration" => $param['duration'],
                                "camilo" => $km,
                            ];
                            $txt = $km."\r\n";
                            fwrite($myfile, $txt);
                            Camilo::create($data);
                            if($x == $shuliang){
                                break;
                            }
                        }
                    }
                }
                $urls = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME');
                fclose($myfile);
                return to_assign(0, '卡类添加成功',["download"=>$urls.'/'.$kmfle]);
            }
        }
    }

    /**
     * 删除卡密
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
            $result = Camilo::destroy($ids);
            if ($result == true) {
                return to_assign(0, '卡密删除成功');
            } else {
                return to_assign(1, '卡密删除失败');
            }
        }
    }
}