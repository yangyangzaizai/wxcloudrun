<?php

namespace app\api\controller;

use app\admin\model\Camilo;
use app\api\BaseController;
use app\api\middleware\Auth;
use app\api\service\JwtAuth;
use think\facade\Db;
use think\facade\Request;
use hg\apidoc\annotation as Apidoc;

/**
 * @Apidoc\Title("V1版本API")
 * @Apidoc\Group("base")
 */
class V1 extends BaseController
{

    protected $middleware = [
        Auth::class => ['except' 	=> ['index','detection','apply','ptreg','kmreg','ptlogin','kmlogin','recharge',"unbundle","kmunbundle",'forcelogin'] ]
    ];

    /**
     * @Apidoc\Title("接口说明")
     * @Apidoc\Desc("所有接口返回数据的sign签名算法是<br/>data数组添加code和time参数，然后根据键名升序排序，排序后进行字符串拼接，拼接方式：键名=值加&拼接，比如key=123&id=666<br/>拼接后的字符串前后加上 secretKey 然后进行sha1算法得来")
     */
    public function index()
    {
        $data = get_params();
        if(!empty($data['id'])){
            $key="776655";
            $jiami = rc4b($key,"49A07D6D535F");
            $jiami = iconv('GBK','UTF-8',$jiami);
        }else{
            $key="kU1VDCcxQGZFrBvMd45fnPbzOw9gjl6Ht7i2a0mRWSq3hAYuNpso";
            $jiami = rc4a($key,"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ3d3cuYmFpZHUuY29tIiwiYXVkIjoibXlhZG1pbiIsImlhdCI6MTcyNjIwOTk2NywiZXhwIjoxNzI2MjEzNTY3LCJ1aWQiOjN9.sCyituYmSQl7MOhtrSDz4FW3JY57Pue5jwY7ivv0Y6E,K9HfnxhzlAy7YRI6EBWDe3Fp2PdwO1vGTgu8mXL0oJiQZrs5tMUS,http://ymyz.l.dyzyk.top,1ffc3b0805ab0eee5e86f20ab22a8726");
        }

        return $jiami;
    }

    /**
     * @Apidoc\Title("软件信息")
     * @Apidoc\Desc("取得软件信息进行初始化")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("软件信息")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Returned("id", type="int", desc="用户id")
     * @Apidoc\Returned("pid", type="int", desc="软件id")
     * @Apidoc\Returned("title", type="string", desc="软件名称")
     * @Apidoc\Returned("versions", type="string", desc="软件版本")
     * @Apidoc\Returned("notice", type="string", desc="软件公告")
     * @Apidoc\Returned("loginway", type="int", desc="登陆方式（1:账号密码 2:卡密）")
     * @Apidoc\Returned("updatestat", type="int", desc="更新方式（1:本地MD5更新 2:远程压缩包更新）")
     * @Apidoc\Returned("catalogue", type="string", desc="本地MD5更新目录（本地MD5更新有效）")
     * @Apidoc\Returned("loRangeurl", type="string", desc="远程更新url（远程压缩包更新有效）")
     * @Apidoc\Returned("status", type="int", desc="状态(0禁用,1启用)")
     * @Apidoc\Returned("create_time", type="int", desc="创建时间（时间戳）")
     * @Apidoc\Returned("update_time", type="int", desc="更新时间（时间戳）")
     */
    public function apply()
    {
        $data = get_params();
        if(empty($data['id']) or empty($data['secretKey'])){
            $this->apiError('参数错误');
        }
        $shuju = Db::name('software')->where(['id'=>$data['id'],"secretKey"=>$data['secretKey']])->find();
        if($shuju){
            if($shuju['status'] != 0){
                //$this->apiSuccess('请求成功',$shuju);
                $this->apiReturn($shuju,1,'请求成功');
                //return result(200, '获取成功',$shuju);
            }else{
                $this->apiError('此软件已被禁用');
            }
        }else{
            $this->apiError('该软件不存在！');
        }
    }

    /**
     * @Apidoc\Title("普通用户注册")
     * @Apidoc\Desc("普通用户注册")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("普通用户注册")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Param("username", type="string",require=true, desc="用户名")
     * @Apidoc\Param("password", type="string",require=true, desc="密码")
     * @Apidoc\Returned("id", type="int", desc="用户id")
     */
    public function ptreg()
    {
        $data = get_params();
        $param = [];
        if(empty($data['id']) or empty($data['secretKey']) or empty($data['username']) or empty($data['password'])){
            $this->apiError('参数错误');
        }
        $user = Db::name('user')->where(['username' => $data['username'],"pid"=>$data['id']])->find();
        if (!empty($user)) {
            $this->apiError('该账户已经存在');
        }
        $param['pid'] = $data['id'];
        $param['username'] = $data['username'];
        $param['salt'] = set_salt(20);
        $param['password'] = set_password($data['password'], $param['salt']);
        $param['create_time'] = time();
        $param['register_ip'] = request()->ip();
        $uid = Db::name('User')->strict(false)->field(true)->insertGetId($param);
        if($uid){
            $this->apiSuccess('注册成功',['id'=>$uid]);
        }else{
            $this->apiError('注册失败');
        }
    }

    /**
     * @Apidoc\Title("卡密用户注册")
     * @Apidoc\Desc("卡密用户注册")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("卡密用户注册")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Param("camilo", type="string",require=true, desc="卡密")
     * @Apidoc\Returned("id", type="int", desc="用户id")
     */
    public function kmreg()
    {
        $data = get_params();
        $param = [];
        if(empty($data['id']) or empty($data['secretKey']) or empty($data['camilo'])){
            $this->apiError('参数错误');
        }
        $user = Db::name('camilouser')->where(['camilo' => $data['camilo'],"pid"=>$data['id']])->find();
        if (!empty($user)) {
            $this->apiError('该账户已经存在');
        }
        $km = Db::name('camilo')->where(['camilo' => $data['camilo'],"pid"=>$data['id']])->find();
        if(!$km){
            $this->apiError('卡密不存在或已被禁用',[],-1);
        }
        if($km['activate'] == 1 && $km['status'] == 0){
            $this->apiError('卡密已使用或已被禁用',[],-1);
        }
        $kl = Db::name('card')->where(["id"=>$km['card_id'],"pid"=>$data['id']])->find();
        $param['pid'] = $data['id'];
        $param['camilo'] = $data['camilo'];
        $param['activate_time'] = time();
        $param['expiration_time'] = strtotime(time_calculate($km['duration'],$kl['cardtype']));
        $param['create_time'] = time();
        $param['login_ip'] = request()->ip();
        $uid = Db::name('camilouser')->strict(false)->field(true)->insertGetId($param);
        if($uid){
            $result1 = Camilo::update(["activate"=>1],["camilo"=>$param['camilo']]);
            $this->apiSuccess('注册成功',['id'=>$uid]);
        }else{
            $this->apiError('注册失败');
        }
    }

    /**
     * @Apidoc\Title("普通用户登陆")
     * @Apidoc\Desc("普通用户登陆")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("普通用户登陆")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Param("username", type="string",require=true, desc="用户名")
     * @Apidoc\Param("password", type="string",require=true, desc="密码")
     * @Apidoc\Param("machine", type="string",require=true, desc="机器码")
     * @Apidoc\Returned("token", type="int", desc="用户token")
     * @Apidoc\Returned("time", type="int", desc="用户授权到期时间戳")
     */
    public function ptlogin()
    {
        $data = get_params();
        $param = [];
        if(empty($data['id']) or empty($data['secretKey']) or empty($data['machine']) or empty($data['username']) or empty($data['password'])){
            $this->apiError('参数错误');
        }
        $user = Db::name('user')->where(['username' => $data['username'],"pid"=>$data['id']])->find();
        $userid = $user['id'];
        $ruanjian = Db::name('software')->where(['id'=>$data['id']])->find();
        if (empty($user)) {
            $this->apiError('该账户不存在');
        }
        $param['password'] = set_password($data['password'], $user['salt']);
        if($user['password'] != $param['password']){
            $this->apiError('密码错误');
        }
        $xh_time = time();
        if($user['expiration_time'] < $xh_time){
            $this->apiError('用户已到期！');
        }
        if($ruanjian['moremachine'] == 1){
            $qzsjq = Db::name('machineku')->where(['pid'=>$data['id'],'uid'=>$userid,'type'=>0])->count();
            $qzsm = Db::name('machineku')->where(['pid'=>$data['id'],'uid'=>$userid,'machine'=>$data['machine'],'type'=>0])->count();

            if($qzsm == 0){
                if($qzsjq == (int)$ruanjian['setNumber']){
                    $this->apiError('已达到绑定机器限额');
                }
                $tjjqmku = [
                    "pid" => $data['id'],
                    "uid" => $user['id'],
                    "machine" => $data['machine'],
                    'type'=>0,
                    "create_time" => time(),
                    "update_time" => time()
                ];
                Db::name('machineku')->insert($tjjqmku);
                $data1 = [
                    'login_ip' => request()->ip(),
                    'login_time' => time(),
                    'last_login_ip' => $user['login_ip'],
                    'last_login_time' => $user['login_time'],
                    'login_num' => $user['login_num'] + 1,
                ];
                $res = Db::name('user')->where(['id' => $user['id']])->update($data1);
                if($res){
                    //获取jwt的句柄
                    $jwtAuth = JwtAuth::getInstance();
                    $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
                    $data2 = [
                        'login_token' => $token,
                    ];
                    Db::name('user')->where(['id' => $user['id']])->update($data2);
                    $this->apiSuccess('登录成功',['token' => $token,"time"=>$user['expiration_time']]);
                }
            }else{
                $data1 = [
                    'login_ip' => request()->ip(),
                    'login_time' => time(),
                    'last_login_ip' => $user['login_ip'],
                    'last_login_time' => $user['login_time'],
                    'login_num' => $user['login_num'] + 1,
                ];
                $res = Db::name('user')->where(['id' => $user['id']])->update($data1);
                if($res){
                    //获取jwt的句柄
                    $jwtAuth = JwtAuth::getInstance();
                    $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
                    $data2 = [
                        'login_token' => $token,
                    ];
                    //echo $token;
                    Db::name('user')->where(['id' => $user['id']])->update($data2);
                    $this->apiSuccess('登录成功',['token' => $token,"time"=>$user['expiration_time']]);
                }
            }
//            if($qzsjq == (int)$ruanjian['setNumber']){
//                $this->apiError('已达到绑定机器限额');
//            }
//            if($qzsm == 0){
//                $tjjqmku = [
//                    "pid" => $data['id'],
//                    "uid" => $user['id'],
//                    "machine" => $data['machine'],
//                    "create_time" => time(),
//                    "update_time" => time()
//                ];
//                Db::name('machineku')->insert($tjjqmku);
//            }
//            $data1 = [
//                'login_ip' => request()->ip(),
//                'login_time' => time(),
//                'last_login_ip' => $user['login_ip'],
//                'last_login_time' => $user['login_time'],
//                'login_num' => $user['login_num'] + 1,
//            ];
//            $res = Db::name('user')->where(['id' => $user['id']])->update($data1);
//            if($res){
//                //获取jwt的句柄
//                $jwtAuth = JwtAuth::getInstance();
//                $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
//                $data2 = [
//                    'login_token' => $token,
//                ];
//                Db::name('user')->where(['id' => $user['id']])->update($data2);
//                $this->apiSuccess('登录成功',['token' => $token]);
//            }

        }elseif($ruanjian['moremachine'] == 2){
            $qzsm = Db::name('machineku')->where(['pid'=>$data['id'],'uid'=>$userid,'machine'=>$data['machine']])->find();
            if($qzsm['machine'] != "" or $qzsm['machine'] != null){
                if($qzsm['machine'] != $data['machine']){
                    $this->apiError('请换绑机器！谢谢！',[],2);
                }
            }
            $qztoken = Db::name('machineku')->where(['pid'=>$data['id'],'uid'=>$userid,'type'=>0])->count();
            if($qztoken != 0){
                $urls = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME');
                $urls = $urls.'/api/v1/hquid';
                $header = array('token:'.$qztoken['login_token']);
                $fanh = curl_posts($urls,$header);
                $fanh = json_decode($fanh, true);
                if($fanh['code'] == '111'){

                    $data1 = [
                        'login_ip' => request()->ip(),
                        'login_time' => time(),
                        'last_login_ip' => $user['login_ip'],
                        'last_login_time' => $user['login_time'],
                        'login_num' => $user['login_num'] + 1,
                    ];
                    $res = Db::name('user')->where(['id' => $data['id']])->update($data1);
                    if($res){
                        //获取jwt的句柄
                        $jwtAuth = JwtAuth::getInstance();
                        $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
                        $data2 = [
                            'login_token' => $token,
                        ];
                        Db::name('user')->where(['id' => $user['id']])->update($data2);
                        $this->apiSuccess('登录成功',['token' => $token,"time"=>$user['expiration_time']]);
                    }

                }else{
                    $this->apiError('禁止多次登陆！如需强制登录，请使用强制登录方式，强制登录将会扣时！');
                }
            }else{
                $data1 = [
                    'login_ip' => request()->ip(),
                    'login_time' => time(),
                    'last_login_ip' => $user['login_ip'],
                    'last_login_time' => $user['login_time'],
                    'login_num' => $user['login_num'] + 1,
                ];
                $res = Db::name('user')->where(['id' => $user['id']])->update($data1);
                if($res){
                    //获取jwt的句柄
                    $jwtAuth = JwtAuth::getInstance();
                    $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
                    $data2 = [
                        'login_token' => $token,
                    ];
                    Db::name('user')->where(['id' => $user['id']])->update($data2);
                    $this->apiSuccess('登录成功',['token' => $token,"time"=>$user['expiration_time']]);
                }
            }
        }
    }

    /**
     * @Apidoc\Title("卡密用户登陆")
     * @Apidoc\Desc("卡密用户登陆")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("卡密用户登陆")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Param("camilo", type="string",require=true, desc="卡密")
     * @Apidoc\Param("machine", type="string",require=true, desc="机器码")
     * @Apidoc\Returned("token", type="int", desc="用户token")
     */
    public function kmlogin()
    {
        $data = get_params();
        $param = [];
        if(empty($data['id']) or empty($data['secretKey']) or empty($data['machine']) or empty($data['camilo'])){
            $this->apiError('参数错误');
        }
        $user = Db::name('camilouser')->where(['camilo' => $data['camilo'],"pid"=>$data['id']])->find();
        if (!$user) {
            $this->apiError('该账户不存在');
        }
        $ruanjian = Db::name('software')->where(['id'=>$data['id']])->find();
        if(!$ruanjian){
            $this->apiError('软件不存在');
        }
        $userid = $user['id'];
        $xh_time = time();
        if($user['expiration_time'] < $xh_time){
            $this->apiError('用户已到期！');
        }

        if($ruanjian['moremachine'] == 1){
            $qzsjq = Db::name('machineku')->where(['pid'=>$data['id'],'uid'=>$userid,'type'=>1])->count();
            $qzsm = Db::name('machineku')->where(['pid'=>$data['id'],'uid'=>$userid,'machine'=>$data['machine'],'type'=>1])->count();

            if($qzsm == 0){
                if($qzsjq == (int)$ruanjian['setNumber']){
                    $this->apiError('已达到绑定机器限额');
                }
                $tjjqmku = [
                    "pid" => $data['id'],
                    "uid" => $user['id'],
                    "type" => 1,
                    "machine" => $data['machine'],
                    "create_time" => time(),
                    "update_time" => time()
                ];
                Db::name('machineku')->insert($tjjqmku);

                $data1 = [
                    'login_ip' => request()->ip(),
                    'login_time' => time(),
                    'last_login_ip' => $user['login_ip'],
                    'last_login_time' => $user['login_time'],
                    'login_num' => $user['login_num'] + 1,
                ];
                $res = Db::name('camilouser')->where(['id' => $user['id']])->update($data1);
                if($res){
                    //获取jwt的句柄
                    $jwtAuth = JwtAuth::getInstance();
                    $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
                    $data2 = [
                        'login_token' => $token,
                    ];
                    Db::name('camilouser')->where(['id' => $user['id']])->update($data2);
                    $this->apiSuccess('登录成功',['token' => $token,"time"=>$user['expiration_time']]);
                }
            }else{
                $data1 = [
                    'login_ip' => request()->ip(),
                    'login_time' => time(),
                    'last_login_ip' => $user['login_ip'],
                    'last_login_time' => $user['login_time'],
                    'login_num' => $user['login_num'] + 1,
                ];
                $res = Db::name('camilouser')->where(['id' => $user['id']])->update($data1);
                if($res){
                    //获取jwt的句柄
                    $jwtAuth = JwtAuth::getInstance();
                    $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
                    $data2 = [
                        'login_token' => $token,
                    ];
                    Db::name('camilouser')->where(['id' => $user['id']])->update($data2);
                    $this->apiSuccess('登录成功',['token' => $token,"time"=>$user['expiration_time']]);
                }
            }

        }elseif($ruanjian['moremachine'] == 2){
            $qzsm = Db::name('machineku')->where(['pid'=>$data['id'],'uid'=>$userid,'machine'=>$data['machine'],'type'=>1])->find();
            if (!empty($qzsm)) { // 不存在
                if($qzsm['machine'] != "" or $qzsm['machine'] != null){
                    if($qzsm['machine'] != $data['machine']){
                        $this->apiError('请换绑机器！谢谢！',[],2);
                    }
                }
            }

            $qztoken = Db::name('token')->where(['pid'=>$data['id'],'uid'=>$userid])->count();
            if($qztoken != 0){
                $urls = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME');
                $urls = $urls.'/api/v1/hquid';
                $header = array('token:'.$qztoken['login_token']);
                $fanh = curl_posts($urls,$header);
                $fanh = json_decode($fanh, true);
                if($fanh['code'] == '111'){

                    $data1 = [
                        'login_ip' => request()->ip(),
                        'login_time' => time(),
                        'last_login_ip' => $user['login_ip'],
                        'last_login_time' => $user['login_time'],
                        'login_num' => $user['login_num'] + 1,
                    ];
                    $res = Db::name('camilouser')->where(['id' => $data['id']])->update($data1);
                    if($res){
                        //获取jwt的句柄
                        $jwtAuth = JwtAuth::getInstance();
                        $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
                        $data2 = [
                            'login_token' => $token,
                        ];
                        Db::name('camilouser')->where(['id' => $user['id']])->update($data2);
                        $this->apiSuccess('登录成功',['token' => $token,"time"=>$user['expiration_time']]);
                    }

                }else{
                    $this->apiError('禁止多次登陆！如需强制登录，请使用强制登录方式，强制登录将会扣时！');
                }
            }else{
                $data1 = [
                    'login_ip' => request()->ip(),
                    'login_time' => time(),
                    'last_login_ip' => $user['login_ip'],
                    'last_login_time' => $user['login_time'],
                    'login_num' => $user['login_num'] + 1,
                ];
                $res = Db::name('camilouser')->where(['id' => $user['id']])->update($data1);
                if($res){
                    //获取jwt的句柄
                    $jwtAuth = JwtAuth::getInstance();
                    $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
                    $data2 = [
                        'login_token' => $token,
                    ];
                    Db::name('camilouser')->where(['id' => $user['id']])->update($data2);
                    $this->apiSuccess('登录成功',['token' => $token,"time"=>$user['expiration_time']]);
                }
            }
        }
    }
    /**
     * @Apidoc\Title("用户解绑")
     * @Apidoc\Desc("用户解绑并注销登陆")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("用户解绑")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("username", type="string",require=true, desc="用户名或注册卡密")
     * @Apidoc\Param("machine", type="string",require=true, desc="机器码")
     */
    public function unbind(){
        $data = get_params();
        if(empty($data['id']) or empty($data['username']) or empty($data['machine'])){
            $this->apiError('参数错误');
        }
        $type = 0;//0账号用户，1卡密用户
        $bm = 'user';//表名
        $user = Db::name($bm)->where(['username' => $data['username'],"pid"=>$data['id']])->find();
        if(!$user){
            $bm = 'camilouser';
            $type = 1;
            $user = Db::name($bm)->where(['camilo' => $data['username'],"pid"=>$data['id']])->find();
        }
        if (!$user) {
            $this->apiError('该账户不存在');
        }
        $machineku = Db::name("machineku")->where(["pid"=>$data['id'],"uid"=>$user['id'],"type"=>$type,'machine'=>$data['machine']])->find();
        if($machineku){
            $res = Db::name("machineku")->where(["pid"=>$data['id'],"uid"=>$user['id'],"type"=>$type,'machine'=>$data['machine']])->delete();
            if($res){
                $cl = [
                    "login_token" => ''
                ];
                $res = Db::name($bm)->where(["id"=>$user['id']])->update($cl);
                $this->apiSuccess("解绑成功！");
            }else{
                $this->apiError('解绑失败！');
            }
        }else{
            $this->apiError('设备信息有误！');
        }

    }
    /**
     * @Apidoc\Title("用户充值")
     * @Apidoc\Desc("用户充值")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("用户充值")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Param("camilo", type="string",require=true, desc="卡密")
     * @Apidoc\Param("username", type="string",require=true, desc="用户名或原卡密")
     * @Apidoc\Returned("time", type="int", desc="用户到期时间戳")
     */
    public function recharge()
    {
        $data = get_params();
        if(empty($data['id']) or empty($data['secretKey']) or empty($data['username']) or empty($data['camilo'])){
            $this->apiError('参数错误');
        }
        $bm = 'user';
        $user = Db::name($bm)->where(['username' => $data['username'],"pid"=>$data['id']])->find();
        if(!$user){
            $bm = 'camilouser';//表名
            $user = Db::name($bm)->where(['camilo' => $data['username'],"pid"=>$data['id']])->find();
        }
        if (!$user) {
            $this->apiError('该账户不存在');
        }
        $km = Db::name('camilo')->where(['camilo' => $data['camilo'],"pid"=>$data['id']])->find();
        if (!$km) {
            $this->apiError('卡密不存在或不属于此软件');
        }
        if($km['activate'] == 1 || $km['status'] == 0){
            $this->apiError('卡密已使用或已被禁用');
        }
        $kl = Db::name('card')->where(["id"=>$km['card_id'],"pid"=>$data['id']])->find();
        $xh_time = time();
        if($user['expiration_time'] < $xh_time){
            $expiration_time = strtotime(time_calculate($km['duration'],$kl['cardtype']));
        }else{
            $expiration_time = strtotime(time_calculate($km['duration'],$kl['cardtype'],$user['expiration_time']));
        }
        $param = [
            "expiration_time" => $expiration_time
        ];
        $res = Db::name($bm)->where(['id' => $user['id']])->update($param);
        if($res){
            $cl = [
                "activate" => 1
            ];
            $res1 = Db::name('camilo')->where(['camilo' => $data['camilo']])->update($cl);
            if($res1){
                $this->apiSuccess('充值成功',["time"=>$expiration_time]);
            }else{
                $this->apiError('处理卡密失败');
            }
        }else{
            $this->apiError('充值失败');
        }
    }

    /**
     * @Apidoc\Title("更新检测")
     * @Apidoc\Desc("更新检测")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("更新检测")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Param("shuju", type="string",require=true, desc="数据")
     */
    public function detection()
    {
        $data = get_params();
        if(empty($data['id']) or empty($data['shuju']) or empty($data['secretKey'])){
            $this->apiError('参数错误');
        }
        $cx = Db::name('software')->where(["id"=>$data['id'],"secretKey"=>$data['secretKey']])->find();
        if (empty($cx)) {
            $this->apiError('软件不存在');
        }
        if($cx['updatestat'] == 1){
            $jc = Db::name('fileupdate')->where(["pid"=>$data['id']])->select();
            if (empty($jc)) {
                $this->apiSuccess('暂无文件更新');
            }
            $mulu = public_path()."appup\\".$cx['catalogue'];
            $data['shuju'] = strtr($data['shuju'], ':', '=');
            $data['shuju'] = substr($data['shuju'],0,strlen($data['shuju'])-1);
            $m = $data['shuju'];
            $m = explode(",",$m);

            $shuju = [];
            $shuju1 = [];
            foreach ($m as $key=>$item){
                $ms = explode("=",$item);
                $shuju[] = $ms;

            }
            foreach ($shuju as $k=>$value){
                $shuju1[$k]["filename"] = $value[0];
                $shuju1[$k]["md5"] = $value[1];
            }
            $jieguo = [];
            foreach ($jc as $key => $value)
            {
                foreach ($shuju1 as $k => $item)
                {
                    if($value['filename'] == $item['filename']){
                        if($value['md5'] !== $item['md5']){
                            $jieguo[$key]['filename'] = $value['filename'];
                            $jieguo[$key]['md5'] = $value['md5'];
                        }
                    }else{
                        $jieguo[$key]['filename'] = $value['filename'];
                        $jieguo[$key]['md5'] = $value['md5'];
                    }

                }
            }

            $this->apiSuccess('获取成功',$jieguo);
        }else{
            $this->apiSuccess('获取成功',$cx['loRangeurl']);
        }
    }

    /**
     * @Apidoc\Title("普通用户换绑")
     * @Apidoc\Desc("普通用户换绑")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("普通用户换绑")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Param("username", type="string",require=true, desc="用户名")
     * @Apidoc\Param("password", type="string",require=true, desc="用户密码")
     * @Apidoc\Param("machine", type="string",require=true, desc="机器码")
     */
    public function unbundle()
    {
        $data = get_params();

        if(empty($data['id']) or empty($data['secretKey']) or empty($data['username']) or empty($data['password']) or empty($data['machine'])){
            $this->apiError('参数错误');
        }
        $user = Db::name('user')->where(["pid"=>$data['id'],"username"=>$data['username']])->find();
        $rj = Db::name("software")->where(["pid"=>$data['id'],"secretKey"=>$data['secretKey']])->find();
        $jqmku = Db::name("machineku")->where(["pid"=>$data['id'],"uid"=>$user['id']])->find();
        if(empty($user)){
            $this->apiError('请检查用户名是否正确');
        }
        if($user['password'] != set_password($data['password'], $user['salt'])){
            $this->apiError('请检查密码是否正确');
        }
        if($rj['moremachine'] == 1){
            $shuju2 = [
                "expiration_time" => strtotime(time_kouculate($rj['thebuckle'],$rj['time_mod'],$user['expiration_time']))
            ];
            $res = Db::name('user')->where(["pid"=>$data['id'],"username"=>$data['username']])->update($shuju2);
            if($res){
                $res1 = Db::name('machineku')->where(["pid"=>$data['id'],"uid"=>$user['id']])->delete(true);
                if($res1){
                    $this->apiSuccess('换绑成功！');
                }else{
                    $this->apiError('换绑失败！');
                }
            }else{
                $this->apiError('换绑失败！');
            }

        }elseif($rj['moremachine'] == 2){
            $shuju = [
                "machine" => $data['machine']
            ];
            $shuju2 = [
                "expiration_time" => strtotime(time_kouculate($rj['thebuckle'],$rj['time_mod'],$user['expiration_time']))
            ];
            $res = Db::name('user')->where(["pid"=>$data['id'],"username"=>$data['username']])->update($shuju2);
            if($res){
                $res1 = Db::name('machineku')->where(["pid"=>$data['id'],"uid"=>$data['id']])->update($shuju);
                if($res1){
                    $this->apiSuccess('换绑成功！');
                }else{
                    $this->apiError('换绑失败！');
                }
            }else{
                $this->apiError('换绑失败！');
            }
        }
    }

    /**
     * @Apidoc\Title("卡密用户换绑")
     * @Apidoc\Desc("卡密用户换绑")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("卡密用户换绑")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Param("ryptedPass", type="string",require=true, desc="软件加密密码")
     * @Apidoc\Param("camilo", type="string",require=true, desc="卡密")
     * @Apidoc\Param("machine", type="string",require=true, desc="机器码")
     */
    public function kmunbundle()
    {
        $data = get_params();
        if(empty($data['id']) or empty($data['secretKey']) or empty($data['camilo']) or empty($data['machine'])){
            $this->apiError('参数错误');
        }
        $user = Db::name('camilouser')->where(["pid"=>$data['id'],"camilo"=>$data['camilo']])->find();
        $rj = Db::name("software")->where(["id"=>$data['id'],"secretKey"=>$data['secretKey']])->find();
        if(empty($user)){
            $this->apiError('请检查卡密是否正确');
        }

        if($rj['moremachine'] == 1){
            $shuju2 = [
                "expiration_time" => strtotime(time_kouculate($rj['thebuckle'],$rj['time_mod'],$user['expiration_time']))
            ];
            $res = Db::name('camilouser')->where(["pid"=>$data['id'],"camilo"=>$data['camilo']])->update($shuju2);
            if($res){
                $res1 = Db::name('machineku')->where(["pid"=>$data['id'],"uid"=>$user['id'],"type"=>1])->delete(true);
                if($res1){
                    $this->apiSuccess('换绑成功！');
                }else{
                    $this->apiError('换绑失败！',[],201);
                }
            }else{
                $this->apiError('换绑失败！',[],202);
            }

        }elseif($rj['moremachine'] == 2){
            $shuju = [
                "machine" => $data['machine']
            ];
            $shuju2 = [
                "expiration_time" => strtotime(time_kouculate($rj['thebuckle'],$rj['time_mod'],$user['expiration_time']))
            ];
            $res = Db::name('camilouser')->where(["pid"=>$data['id'],"camilo"=>$data['camilo']])->update($shuju2);
            if($res){
                $res1 = Db::name('machineku')->where(["pid"=>$data['id'],"uid"=>$data['id'],"type"=>1])->update($shuju);
                if($res1){
                    $this->apiSuccess('换绑成功！');
                }else{
                    $this->apiError('换绑失败！',[],203);
                }
            }else{
                $this->apiError('换绑失败！',[],204);
            }
        }
    }
    /**
     * @Apidoc\Title("心跳")
     * @Apidoc\Desc("取得软件信息进行初始化")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("软件信息")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Returned("userid", type="int", desc="用户id")
     * @Apidoc\Returned("time", type="int", desc="用户到期时间戳")
     */
    public function xintiao()
    {
        $data = get_params();
        if(empty($data['id']) or empty($data['secretKey']) or empty($data['shuju'])){
            $this->apiError('参数错误');
        }
        $rj = Db::name('software')->where(['id'=>$data['id'],'secretKey'=>$data['secretKey']])->find();
        if(!$rj){
            $this->apiError('异常',[],201);
        }
        $jwtAuth = JwtAuth::getInstance();
        $uid = $jwtAuth->getUid();
        if(empty($uid)){
            $this->apiError('异常',[],202);
        }
        $userInfo = Db::name('user')->where(['id' => $uid])->find();
        if(!$userInfo){
            $userInfo = Db::name('camilouser')->where(['id' => $uid])->find();
            if(!$userInfo){
                $this->apiError('异常',[],203);
            }
        }
        $shuju = $data['shuju'];

        $shuju = rc4b($rj['ryptedPass'],$shuju);
        //var_dump($shuju);
        //$shuju = iconv("GBK", "UTF-8", $shuju);
        //$shuju = iconv('GB2312', 'UTF-8', $shuju);
        //exit($shuju);
        $shuju = explode(",",$shuju);
        if(count($shuju)<3){
            $this->apiError('异常',[],204);
        }
        //exit($shuju[1]);
        //$urls = input('server.REQUEST_SCHEME') . '://' . input('server.SERVER_NAME');
        //var_dump($shuju);
        if($rj['secretKey'] != $shuju[1]){
            $this->apiError('异常',[],205);
        }
        if($shuju[2] != Request::domain()){
            $this->apiError('异常',[],206);
        }
        if($rj['moremachine']==1){
            $jqmku = Db::name('machineku')->where(['pid'=>$data['id'],'uid'=>$uid,'machine'=>$shuju[3]])->count();
            if($jqmku == 0){
                $this->apiError('异常',[],207);
            }
        }else if($userInfo['login_token']!=$shuju[0]){
            $this->apiError('异常',[],208);
        }
        if($userInfo['expiration_time'] <= time()){
            $this->apiError('已到期',["time"=>$userInfo['expiration_time']],209);
        }
        $this->apiSuccess('请求成功',['user' => $uid,"time"=>$userInfo['expiration_time']]);
    }
    /**
     * @Apidoc\Title("获取UID")
     * @Apidoc\Desc("获取当前会员ID")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("获取UID")
     */
    public function hquid()
    {
        $jwtAuth = JwtAuth::getInstance();
        $uid = $jwtAuth->getUid();
        //var_dump($uid);
        $this->apiSuccess('获取成功',["userid"=>$uid]);
    }

    /**
     * 获取用户id
     * @return mixed
     */
    protected function getUid()
    {
        $jwtAuth = JwtAuth::getInstance();
        return $jwtAuth->getUid();
    }
    /**
     * @Apidoc\Title("注销登陆")
     * @Apidoc\Desc("注销当前登陆状态")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("注销登陆")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     */
    public function logouts()
    {
        $data = get_params();
        if(empty($data['id']) or empty($data['secretKey'])){
            $this->apiError('参数错误');
        }
        $jwtAuth = JwtAuth::getInstance();
        $uid = $jwtAuth->getUid();
        $rj = Db::name('software')->where(['id'=>$data['id'],'secretKey'=>$data['secretKey']])->find();
        $cl = [
            "login_token" => ''
        ];
        if($rj['loginway']==1){
            $res = Db::name('user')->where(["id"=>$uid])->update($cl);
            if($res){
                $this->apiSuccess('注销成功！');
            }else{
                $this->apiError('注销失败！');
            }
        }elseif ($rj['loginway']==2){
            $res = Db::name('camilouser')->where(["id"=>$uid])->update($cl);
            if($res){
                $this->apiSuccess('注销成功！');
            }else{
                $this->apiError('注销失败！');
            }
        }
    }
    /**
     * @Apidoc\Title("强制登陆")
     * @Apidoc\Desc("强制登陆用户")
     * @Apidoc\Method("GET,POST")
     * @Apidoc\Author("MYKC")
     * @Apidoc\Tag("强制登陆")
     * @Apidoc\Param("id", type="int",require=true, desc="软件ID")
     * @Apidoc\Param("secretKey", type="string",require=true, desc="软件秘钥")
     * @Apidoc\Param("username", type="string",require=true, desc="用户名")
     * @Apidoc\Param("password", type="string",require=true, desc="密码")
     * @Apidoc\Param("machine", type="string",require=true, desc="机器码")
     */
    public function forcelogin()
    {
        $data = get_params();
        if(empty($data['id']) or empty($data['secretKey']) or empty($data['username']) or empty($data['password']) or empty($data['machine'])){
            $this->apiError('参数错误');
        }
        $user = Db::name('user')->where(['pid'=>$data['id'],"username"=>$data['username']])->find();
        $param['password'] = set_password($data['password'], $user['salt']);
        if($user['password'] != $param['password']){
            $this->apiError('密码错误');
        }
        $xh_time = time();
        if($user['expiration_time'] < $xh_time){
            $this->apiError('用户已到期！');
        }
        if($user['machine'] != "" or $user['machine'] != null){
            if($user['machine'] != $data['machine']){
                $this->apiError('请换绑机器！谢谢！',[],2);
            }
        }
        $rj = Db::name('software')->where(['id'=>$data['id'],'secretKey'=>$data['secretKey']])->find();
        $cldq = strtotime(time_kouculate($rj['thebuckle'],$rj['time_mod'],$user['expiration_time']));
        $data1 = [
            'expiration_time' => $cldq,
            'machine' => $data['machine'],
            'login_ip' => request()->ip(),
            'login_time' => time(),
            'last_login_ip' => $user['login_ip'],
            'last_login_time' => $user['login_time'],
            'login_num' => $user['login_num'] + 1,
        ];
        $res = Db::name('user')->where(['id' => $user['id']])->update($data1);
        if($res){
            //获取jwt的句柄
            $jwtAuth = JwtAuth::getInstance();
            $token = $jwtAuth->setUid($user['id'])->encode()->getToken();
            $data2 = [
                'login_token' => $token,
            ];
            Db::name('user')->where(['id' => $user['id']])->update($data2);
            $this->apiSuccess('登录成功',['token' => $token]);
        }
    }
}
