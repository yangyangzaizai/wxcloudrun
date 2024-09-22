<?php

declare (strict_types = 1);

namespace app\admin\controller;

use app\admin\AdminBase;
use Mykc;
use think\facade\Config;
use think\facade\Db;
use ZipArchive;

class Index extends AdminBase
{
    /**
     * 无需登录的方法
     * @var array
     */
    protected $noNeedLogin = ['index'];

    /**
     * 无需权限判断的方法
     * @var array
     */
    protected $noNeedAuth = ['index', 'main'];

    public function index()
    {
        if (!$this->isLogin()) {
            $this->redirect(url('@admin/login'));
        } else {
            $rz = json_decode(yc(2),true);
            var_dump($rz);
            return view('index', [
                'sidenav'   =>  list_to_tree(getMenuData()),
                'admininfo'  =>  session('admin_info'),
                'gxrz' => [],
            ]);
        }
    }

    /**
     * 显示工作台
     * @return \think\response\View
     */
    public function main()
    {
        $yxkm = Db::name('camilo')->where(['activate'=>0,'status'=>1])->count('id');
        $syrj = Db::name('software')->where(['status'=>1])->count('id');
        $sykmuse = Db::name('camilouser')->where(['status'=>1])->count('id');
        $syptuse = Db::name('user')->where(['status'=>1])->count('id');
        $syzx = Db::name('camilouser')->where('login_time' <> '',['status'=>1])->count('id');
        $versions = yc(1);
        $xzver = xzversion;

        return view('', [
            'version' => \think\facade\App::version(),
            'yxkm' => $yxkm,
            'syrj' => $syrj,
            'syyh' => $sykmuse+$syptuse,
            'syzx' => $syzx,
            'versions' => $versions,
            'xzver' => $xzver
        ]);
    }

    public function xiangq()
    {
        $data = get_params();
        if(empty($data['id'])){
            return to_assign(201, '参数错误');
        }
        $rz = json_decode(yc(3,$data),true);
        return view('',[
            'nr' => $rz['data']
        ]);
    }

    public function lists()
    {
        $rz = json_decode(yc(2),true);
        return view('',[
            'rz' => $rz['data']
        ]);
    }

    public function gx()
    {
        $davs = [
            'new_vues'=>xzversion
        ];
        $rz = json_decode(yc(4,$davs),true);
        $rz = $rz['data'];
//        $res = getFile($rz['flename'], '/', $rz['ssvues'].'.zip', 1);
//        var_dump($res);
        $hostfile = fopen($rz['flename'], 'r');
        $fh = fopen('../'.$rz['ssvues'].'.zip', 'w');

        $banbens = $rz['ssvues'];
        while (!feof($hostfile)) {
            $output = fread($hostfile, 8192);
            fwrite($fh, $output);
        }

        fclose($hostfile);
        fclose($fh);
        $zip = new ZipArchive();
        $flag = $zip->open('../'.$rz['ssvues'].'.zip');
        if($flag!==true){
            echo "open error code: {$flag}\n";
            exit();
        }
        $zip->extractTo('../');
        $flag = $zip->close();
        if(file_exists('../sql.sql')){
            $con = Config::get('database');
            $con = $con['connections']['mysql'];
            $servername = $con['hostname'];
            $dbname = $con['database'];
            $username = $con['username'];
            $password = $con['password'];
            insert('../sql.sql',$dbname,$servername,$username,$password);
            //insert("../sql.sql","ceshi","localhost","ceshi","p8aScnL3FxPBckX2");
//            $data = array("dbhost"=>$servername,"dbuser"=>$username,"dbpw"=>$password,"dbname"=>$dbname);
//        $obj = new \Mykc($data);
//        $obj->import_data('../sql.sql');
        }
        if(file_exists('../'.$rz['ssvues'].'.zip')){
            unlink('../'.$rz['ssvues'].'.zip');
        }
        if(file_exists('../sql.sql')){
            unlink('../sql.sql');
        }
        $file_path = "index.php";
        if(file_exists($file_path)){
            $fp = fopen($file_path,"r");
            $str = fread($fp,filesize($file_path));//指定读取大小，这里把整个文件内容读取出来
            //echo $str = str_replace("\r\n","<br />",$str);
            $str = str_replace("define('xzversion', '".xzversion."');","define('xzversion', '".$banbens."');",$str);
            file_put_contents('index.php', $str);
            return to_assign(0, '处理完成！',$rz);
        }
        //$putConfig = @file_put_contents("/index.php", $sye);
        //return to_assign(0, '处理完成！',$rz);
    }

    public function yijian()
    {
        $data = get_params();
        $rz = json_decode(yc(5,$data),true);
        return $rz;
    }
}
