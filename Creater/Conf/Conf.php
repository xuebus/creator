<?php
/**
 * Created by PhpStorm.
 * User: edwinchan
 * Date: 2018/7/11
 * Time: 下午10:35
 */


const FRAME   = 'ODP';
const DB_NAME = 'information_schema';
$conf = array(
    //pdo数据库配置文件
    'PDO' => [
        'DB_TYPE'    => 'mysql',           //数据库类型
        'DB_HOST'    => '127.0.0.1',       //服务器地址
        'DB_PORT'    => '3306',            //端口
        'DB_USER'    => 'root',            //用户名
        'DB_PWD'     => 'root',            //密码
        'DB_NAME'    => DB_NAME,           //数据库名称
        'DB_CHARSET' => 'utf8',            //数据库编码
    ],

    //基础配置
    'FRAME' => FRAME,              //框架

    //文件注释
    'NOTE' => [
        'AUTHOR' => 'chenzhiwen',
    ],
);



switch (FRAME)
{
    case 'ODP' :
        $conf['ODP'] = require_once(CONF_PATH."OdpConf".DS."Conf.php");
        return $conf;
    break;
}




