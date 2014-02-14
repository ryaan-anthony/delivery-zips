<?php

class Ip_Delivery_Model_Zips extends Mage_Core_Model_Abstract
{
    protected function _construct()
    {
        $this->_init('delivery/zips');
    }

    public function loadByAttribute($attr, $value)
    {
        $id = $this->getResource()->loadByAttribute($attr, $value);
        $this->load($id);
        return $this;
    }

}