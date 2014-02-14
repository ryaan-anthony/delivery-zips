<?php

class Ip_Delivery_Block_Adminhtml_Zips_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $data = Mage::registry('zips_data');

        $form = new Varien_Data_Form(array(
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', array('zip_id' => $this->getRequest()->getParam('zip_id'))),
            'method' => 'post',
            'enctype' => 'multipart/form-data',
        ));

        $form->setUseContainer(true);

        $this->setForm($form);

        $fieldset = $form->addFieldset('zip_form', array(
            'legend' =>Mage::helper('delivery')->__('Zip Code')
        ));


        $fieldset->addField('zip_code', 'text', array(
            'label'     => Mage::helper('delivery')->__('Zip Code'),
            'name'      => 'zip_code',
        ));
        $fieldset->addField('rate', 'text', array(
            'label'     => Mage::helper('delivery')->__('Rate'),
            'name'      => 'rate',
        ));

        $form->setValues($data);

        return parent::_prepareForm();
    }

/*    protected function getArray($array)
    {
        $res = array();
        foreach($array as $key => $val){
            $res[] = array('value' => $key, 'label' => $val);
        }
        return $res;
    }*/
}