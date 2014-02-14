<?php

class Ip_Delivery_Adminhtml_ZipsController extends Mage_Adminhtml_Controller_Action
{

    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $model = Mage::getModel('delivery/zips');
        if($id = $this->getRequest()->getParam('zip_id', null)){
            $model->load($id);
        }
        Mage::register('zips_data', $model);
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($postData = $this->getRequest()->getPost()) {
            $model = Mage::getSingleton('delivery/zips');
            /* set all post data */
            $model->setData($postData);
            /* set the id instead of loading for simplicity */
            if($id = $this->getRequest()->getParam('zip_id', null)){
                $model->setZipId($id);
            }
            try {
                $model->save();
                Mage::getSingleton('adminhtml/session')->addSuccess($this->__('The zip code has been saved.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Mage_Core_Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($this->__('An error occurred while saving this zip code.'));
            }
            Mage::getSingleton('adminhtml/session')->setZipsData($postData);
            $this->_redirectReferer();
        }
        $this->_redirect('*/*/');
    }


}