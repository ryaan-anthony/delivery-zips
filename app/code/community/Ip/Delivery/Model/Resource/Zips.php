<?php

class Ip_Delivery_Model_Resource_Zips extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('delivery/zips', 'zip_id');
    }

    public function loadByAttribute($attr, $value)
    {
        $table = $this->getMainTable();
        $read = $this->_getReadAdapter();
        $where = $read->quoteInto("$attr = ?", $value);
        $sql = $read->select()
            ->from($table, array('zip_id'))
            ->where($where);
        return $read->fetchOne($sql);
    }
}