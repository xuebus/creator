<?php
/***************************************************************************
 * Copyright (c) 2013 Baidu.com, Inc. All Rights Reserved
 **************************************************************************/


/**
 * @file    TransBase.php
 * @author  zhengzhiqing@zuoyebang.com
 * @date    2015-3-13
 * @brief   base class
 **/
abstract class MisFz_TransBase
{
    protected $_dbName    = '';
    protected $_dbCtrl    = false;
    protected $_arrOutPut = array();

    function __construct() {
        $this->_dbName = "flipped/zyb_flipped";
        $this->_dbCtrl = Hk_Service_Db::getDB($this->_dbName);
    }

    /*
     * @brief protected function
     */
    abstract protected function execute($arrInput);

    public function startTrans() {
        return $this->_dbCtrl->startTransaction();
    }

    public function rollback() {
        return $this->_dbCtrl->rollback();
    }

    public function commit() {
        return $this->_dbCtrl->commit();
    }

    function __destruct() {
        return true;
    }
}
