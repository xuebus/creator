<?php
/**
 * Created by PhpStorm.
 * User: edwinchan
 * Date: 2018/7/15
 * Time: 下午3:10
 */
return array(
    //odp的模板类型
    'TEMPLATES' => [
        'dao'  => 'dao.tmpl',
    ],
    //odp文件路径分割符
    'ODP_DS' => '_',


    //dao层相关配置
    'DAO' => [
        'PARENT_CLASS' => 'Hk_Common_BaseDao',   //父类
        'DB'           => 'Hk_Service_Db::getDB( $this->_dbName )', //DB
        'LOG_FILE'     => 'Hkzb_Util_FuDao::DBLOG_FUDAO',    //日志文件
        'TYPES_MAP'    => [
            'bigint'     => 'Hk_Service_Db::TYPE_INT',
            'blob'       => 'Hk_Service_Db::TYPE_INT',
            'char'       => 'Hk_Service_Db::TYPE_STR',
            'date'       => 'Hk_Service_Db::TYPE_STR',
            'datetime'   => 'Hk_Service_Db::TYPE_STR',
            'int'        => 'Hk_Service_Db::TYPE_INT',
            'longblob'   => 'Hk_Service_Db::TYPE_INT',
            'mediumblob' => 'Hk_Service_Db::TYPE_INT',
            'smallint'   => 'Hk_Service_Db::TYPE_INT',
            'text'       => 'Hk_Service_Db::TYPE_JSON',
            'time'       => 'Hk_Service_Db::TYPE_STR',
            'timestamp'  => 'Hk_Service_Db::TYPE_STR',
            'tinyint'    => 'Hk_Service_Db::TYPE_INT',
            'varchar'    => 'Hk_Service_Db::TYPE_STR',
        ]
    ]
);