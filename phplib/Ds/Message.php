<?php
/**
 * file  : Message.php
 * author: chenzhiwen
 * date  : 2018/08/15
 * brief :
 */
class Message  {

    private $_objExample;

    const ALL_FIELDS = '';

	public function __construct(){
        $this->_objDaoExample = new Fz_Dao_Example();
	}

    /**
     * 根据多条件获取数目
     * @param $arrCond
     * @return mixed
     */
    public function getCntByCond($arrCond) {
        if (empty($arrCond)) {
            return 0;
        }
        $ret = $this->_objDaoExample->getCntByConds($arrCond);
        return $ret;
    }

    /**
     * 根据多条件获取list
     * @param $arrCond
     * @param array $arrFields
     * @param int $offset
     * @param int $limit
     * @return array|false
     */
    public function getListByCond($arrCond = array(), $arrFields = array(), $offset = 0, $limit = 30) {
        if (empty($arrCond) || !is_array($arrCond)) {
            Bd_Log::warning("Error[param error]");
            return array();
        }

        if (empty($arrFields)) {
            $arrFields = explode(',', self::ALL_FIELDS);
        }

        $arrAppends = array(
            "order by create_time desc",
            "limit $offset, $limit",
        );

        $list = $this->_objDaoExample->getListByConds($arrCond, $arrFields, NULL, $arrAppends);

        return $list;
    }

}
