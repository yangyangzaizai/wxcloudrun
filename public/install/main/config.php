<?php
/*
 * // +----------------------------------------------------------------------
 * // | 梦亚网络验证
 * // +----------------------------------------------------------------------
 * // | 版权所有 2020~2050 天津梦亚科创
 * // +----------------------------------------------------------------------
 * // | 开源协议 ( https://mit-license.org )
 * // +----------------------------------------------------------------------
 * // | QQ交流更新群：732808689
 * // +----------------------------------------------------------------------
 * // | Author: 梦亚科创 <2559584938@qq.com>    微信号：MYKC-2022
 * // +----------------------------------------------------------------------
 */


$urls = 'https://api.dream-kc.com/api/index/uplist';
//初始化
$curl = curl_init();
//设置抓取的url
curl_setopt($curl, CURLOPT_URL, $urls);
//设置头文件的信息作为数据流输出
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。
$data = curl_exec($curl);
curl_close($curl);
//显示获得的数据
echo $data;