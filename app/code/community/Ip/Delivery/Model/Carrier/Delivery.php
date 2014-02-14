<?php

class Ip_Delivery_Model_Carrier_Delivery extends Mage_Shipping_Model_Carrier_Abstract
{

    protected $_code = 'delivery';

    public function collectRates(Mage_Shipping_Model_Rate_Request $request)
    {
        if (!Mage::getStoreConfig('carriers/'.$this->_code.'/active')){
            return false;
        }
        $rate = $this->getRate();
        if($rate !== false){
            $result = Mage::getModel('shipping/rate_result');
            $method = Mage::getModel('shipping/rate_result_method');
            $method->setCarrier($this->_code);
            $method->setCarrierTitle(Mage::getStoreConfig('carriers/'.$this->_code.'/title'));
            /* Use method name */
            $method->setMethod($this->_code);
            $method->setMethodTitle(Mage::getStoreConfig('carriers/'.$this->_code.'/methodtitle'));
            $method->setCost($rate);
            $method->setPrice($rate);
            $result->append($method);
            return $result;
        }
        return false;
    }

    public function getRate()
    {
        $rate = 0;
        /* @var Mage_Sales_Model_Quote $quote */
        $quote = Mage::getSingleton('checkout/session')->getQuote();
        $zip_code = $quote->getShippingAddress()->getPostcode();
        $zip_code_part = explode('-',$zip_code);
        $zip_code = $zip_code_part[0];
        if(strlen($zip_code) == 5){
            /* @var $zips Ip_Delivery_Model_Zips */
            $zips = Mage::getModel('delivery/zips')->loadByAttribute('zip_code', $zip_code);
            //no rate found
            if(!$zips || !$zips->getZipId()){
                return false;
            }
            //free shipping!
            if($quote->getShippingAddress()->getFreeShipping() &&
                Mage::getStoreConfig('carriers/'.$this->_code.'/applyfree')){
                return 0;
            }
            //no rate found
            if(!$rate = $zips->getData('rate')){
                return false;
            }
            //invalid zip
        }elseif(strlen($zip_code) > 0){
            return false;
        }
        return $rate;
    }



}