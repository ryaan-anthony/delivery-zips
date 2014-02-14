<?php

class Ip_Delivery_Block_Adminhtml_Zips_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'zip_id';
        $this->_blockGroup = 'delivery';
        $this->_controller = 'adminhtml_zips';
        $this->_mode = 'edit';
        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('form_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'edit_form');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'edit_form');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('zips_data') && Mage::registry('zips_data')->getZipId()){
            return Mage::helper('delivery')->__('Zip Code: "#%s"', $this->htmlEscape(Mage::registry('zips_data')->getZipCode()));
        } else {
            return Mage::helper('delivery')->__('New Zip Code');
        }
    }

}