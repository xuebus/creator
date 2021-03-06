<?php
/**
 * Created by PhpStorm.
 * User: edwinchan
 * Date: 2018/7/12
 * Time: 下午11:40
 */
namespace Creater\App\Odp;

use Creater\App\CreateBase;
use Creater\App\TableCreate;
use Creater\Helper\CommonHelper;
use Creater\Helper\FileHelper;
use Creater\Helper\TemplateHelper;

class CreateDao extends CreateBase
{
    use TableCreate;

    public function __construct($params)
    {
        parent::__construct($params);
        $this->_Config = $GLOBALS['config']['ODP']['DAO'];
    }

    /**
     * 创建
     */
    public function create()
    {
        //初始化
        $this->DBConstruct();
        //设置表名
        $this->setTableName($this->params['db_name']);
        //获取数据
        $columnList = $this->getColumnList();
        //生成字段 & 字段类型
        $fieldsMap  = array();
        $typesMap   = array();
        foreach ($columnList as $column) {
            $fieldsMap[] = [
                CommonHelper::convertUnderline($column['COLUMN_NAME'],false) => $column['COLUMN_NAME'] ,
            ];

            $typesMap[] = [
                CommonHelper::convertUnderline($column['COLUMN_NAME'],false) =>
                    strpos($column['COLUMN_COMMENT'],$this->_Config['TYPE_JSON_FLAG']) ? $this->_Config['TYPE_JSON'] : $this->_Config['TYPES_MAP'][$column['DATA_TYPE']],
            ];
        }

        //字段格式化
        $strFieldsMap = CommonHelper::array2strFormat($fieldsMap);
        $strTypesMap  = CommonHelper::array2strFormat($typesMap,true);

        //分表相关
        $partionKey  = '';
        $partionType = '';
        $partionNum  = '';
        $firstColumn = CommonHelper::convertUnderline($columnList[0]['COLUMN_NAME'],false);
        //取模分表 || 固定大小分表
        $partion = $this->_Config['BASE_CONFIG']['PARTION'];
        if (in_array($partion,$this->params['base_config'])) {
            $key = array_search($partion,$this->params['base_config']) + 1;
            $par = strtoupper($this->params['base_config'][$key]);
            if (!isset($this->_Config['PARTION'][$par])) {
                echo 'PARAM ERROR!';
                exit;
            }
            $partionKey  = '$this->_partionKey  = ' . "'{$firstColumn}';";
            $partionType = '$this->_partionType = ' . $this->_Config['PARTION'][$par]['PARTION_TYPE'].';';
            $partionNum  = '$this->_partionNum  = ' . $this->_Config['PARTION'][$par]['PARTION_NUM'].';';
        }

        //拼装数组
        $map = [
            'CLASS_NAME'   => $this->params['base_name'],
            'PARENT_CLASS' => !empty($this->_Config['PARENT_CLASS']) ? 'extends ' . $this->_Config['PARENT_CLASS'] : '',
            'DB_NAME'      => $this->_Config['DB_NAME'],
            'DB'           => $this->_Config['DB'],
            'LOG_FILE'     => $this->_Config['LOG_FILE'],
            'DB_TABLE'     => $this->_TableName,
            'FIELDS_MAP'   => $strFieldsMap,
            'TYPES_MAP'    => $strTypesMap,
            'PARTION_KEY'  => $partionKey,
            'PARTION_NUM'  => $partionType,
            'PARTION_TYPE' => $partionNum,
        ];

        $map = array_merge($map,$this->note);

        //获取模板
        $tmpl = TemplateHelper::fetchTemplate('dao');
        //填充模板
        $this->content = TemplateHelper::parseTemplateTags($map,$tmpl);
        FileHelper::writeToFile($this->content,$this->params['path'],$this->params['file_name'],$this->_Config['FILE_NAME_TEMP']);
        echo 'CREATE SUCCESS !' . PHP_EOL;
    }

}