<?php

class Ip_Delivery_Block_Adminhtml_Zips extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    //protected $_addButtonLabel = 'Add New';

    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_zips';
        $this->_blockGroup = 'delivery';
        $this->_headerText = Mage::helper('delivery')->__('Delivery Zip Codes');
    }

}