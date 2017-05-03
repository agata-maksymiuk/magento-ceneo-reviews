<?php

class Handy_CeneoReview_Block_Success
    extends Mage_Core_Block_Template
{

    /* Mage_Sales_Model_Order */
    protected $_order;


    protected function _toHtml()
    {
        if ( !$this->isEnabled() ) {
            return '';
        }
        return parent::_toHtml();
    }

    public function isEnabled()
    {
        return Mage::getStoreConfig('handy_ceneoreview/default/enabled');
    }

    public function getGuid()
    {
        return Mage::getStoreConfig('handy_ceneoreview/default/guid');
    }

    public function getProductIds()
    {
        $ids = array();
        foreach ( $this->getOrder()->getAllVisibleItems() as $item ) {
            $ids[] = $item->getProductId();
        }
        return implode(",",$ids);
    }

    public function getDaysToSendQuestionnaire()
    {
        return Mage::getStoreConfig('handy_ceneoreview/default/days_to_send_questionnaire');
    }

    /**
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
        if ( !$this->_order ) {
            $this->_order = Mage::getModel('sales/order');
            $orderId = Mage::getSingleton('checkout/session')->getLastOrderId();
            $this->_order->load($orderId);
        }
        return $this->_order;
    }
}
