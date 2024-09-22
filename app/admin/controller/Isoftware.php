<?php

namespace app\admin\controller;

use app\admin\AdminBase;
use app\admin\model\Software;
use app\admin\model\Classify;
use app\admin\model\Fileupdate;
use think\exception\ValidateException;

class Isoftware extends AdminBase
{
    /**
     * 软件管理
     * @return \think\response\View
     */
    public function index()
    {
        if (request()->isPost()) {
            $data = input('param.');
            $data = Software::where(['id'=>$data['id']])->find();
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
        $list = Software::with(['roles'])->paginate($limit);
        return to_assign(0, '获取成功', $list);
    }

    public function classify()
    {
        $list = Classify::select();
        return to_assign(0, '获取成功', $list);
    }

    public function post_submit()
    {
        if (request()->isPost()) {
            $param = input('param.');
            $mulu = set_salt(10);
            $miyao = set_salt(64);
            if ($param['id'] > 0) {

                $result = Software::update($param, ['id' => $param['id']]);
                if ($result == true) {
                    return to_assign(0, '软件编辑成功');
                } else {
                    return to_assign(1, '软件编辑失败');
                }
            }else{
                $param['secretKey'] = $miyao;
                if($param['updatestat'] == '1'){
                    $param['catalogue'] = $mulu;
                    $dir = iconv("UTF-8", "GBK", public_path()."/appup/".$param['catalogue']);
                    if (!file_exists($dir)){
                        mkdir ($dir,0777,true);
                    }
                }
                $result = Software::create($param);
                if ($result == true) {
                    return to_assign(0, '软件添加成功');
                } else {
                    return to_assign(1, '软件添加失败');
                }
            }
        }
    }

    public function set_submit()
    {
        if (request()->isPost()) {
            $param = input('param.');
            $result = Software::update($param, ['id' => $param['id']]);
            if ($result == true) {
                return to_assign(0, '软件配置成功');
            } else {
                return to_assign(1, '软件配置失败');
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
            $result = Software::destroy($ids);
            if ($result == true) {
                return to_assign(0, '分类删除成功');
            } else {
                return to_assign(1, '分类删除失败');
            }
        }
    }

    public function versionsup()
    {
        if (request()->isPost()) {
            $data = input('param.');
            $shuju = Software::where(['id'=>$data['id']])->find();
            $upmulu = public_path()."appup\\".$shuju['catalogue'];
            foreach (glob($upmulu . '\*') as $file_path) {
                //file change GBK to utf-8
                //$file_path = iconv("GBK","utf-8//IGNORE",$file_path);
                $file_name =  substr($file_path, strlen(dirname($file_path)) + 1);
                $md5file = @md5_file($file_path);
                $pd = Fileupdate::where(['pid'=>$data['id'],"filename"=>$file_name])->find();
                if($pd == null){
                    $tj = [
                        "pid" => $data['id'],
                        "filename" => $file_name,
                        "md5" => $md5file,
                        "create_time" => time(),
                        "update_time" => time(),
                    ];
                    Fileupdate::insert($tj);
                }else{
                    $up = [
                        "md5" => $md5file,
                        "update_time" => time(),
                    ];
                    Fileupdate::update($up,["pid"=>$data['id'],"filename" => $file_name]);
                }
            }
            return to_assign(0, '更新数据处理完成');
        }
    }

    public function sryptedPass()
    {
        if (request()->isPost()) {
            return to_assign(0, '获取成功',set_salt(64));
        }
    }
}