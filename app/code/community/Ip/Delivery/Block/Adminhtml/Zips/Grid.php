<?php

class Ip_Delivery_Block_Adminhtml_Zips_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('zips_grid');
        $this->setDefaultSort('zip_id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('delivery/zips')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('zip_id', array(
            'header'    => Mage::helper('delivery')->__('Zip ID'),
            'align'     =>'right',
            'width'     => '50px',
            'index'     => 'zip_id',
        ));
        $this->addColumn('zip_code', array(
            'header'    => Mage::helper('delivery')->__('Zip Code'),
            'align'     =>'left',
            'index'     => 'zip_code',
        ));
        $this->addColumn('rate', array(
            'header'    => Mage::helper('delivery')->__('Rate'),
            'align'     =>'left',
            'index'     => 'rate',
        ));

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('zip_id' => $row->getZipId()));
    }
}