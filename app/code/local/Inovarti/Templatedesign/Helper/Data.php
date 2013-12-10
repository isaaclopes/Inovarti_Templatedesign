<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Templatedesign
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Templatedesign_Helper_Data extends Mage_Core_Helper_Abstract {

    protected function _loadProduct(Mage_Catalog_Model_Product $product) {
        $product->load($product->getId());
    }

    public function getLabel(Mage_Catalog_Model_Product $product) {
        if ('Mage_Catalog_Model_Product' != get_class($product))
            return;

        $html = '';
        if (!Mage::getStoreConfig("templatedesign/labels/new_label")
                && !Mage::getStoreConfig("templatedesign/labels/promotion_label")
                && !Mage::getStoreConfig("templatedesign/labels/promotion_percent_label")
                && !Mage::getStoreConfig("templatedesign/labels/shipping_label")
        ) {
            return $html;
        }

        $this->_loadProduct($product);

        $html .= '<div class="seal-product-all">';
        if (Mage::getStoreConfig("templatedesign/labels/new_label") && $this->_isNew($product)) {
            $html .= '<span class="seal-product new_label">'.$this->__('New').'</span>';
        }
        if (Mage::getStoreConfig("templatedesign/labels/promotion_label") && $this->_isOnPromotion($product)) {
            $html .= '<span class="seal-product promotion_label">'.$this->__('Promotion').'</span>';
        }
        if (Mage::getStoreConfig("templatedesign/labels/promotion_percent_label") && $this->_isOnPromotionPercent($product) >14) {
            $html .= '<span class="seal-product promotion_percent_label">'.$this->_isOnPromotionPercent($product).'%</span>';
        }
        if (Mage::getStoreConfig("templatedesign/labels/shipping_label") && $this->_isOnFreeShipping($product)) {
            $html .= '<span class="seal-product shipping_label">'.$this->__('Free Shipping').'</span>';
        }
        $html .= '</div>';
        return $html;
    }

    protected function _isNew($product) {
        $from = strtotime($product->getNewsFromDate());
        $to = strtotime($product->getNewsFromDate());

        return $this->_checkDate($from, $to);
    }
    protected function _isOnPromotion($product) {
        $from = strtotime($product->getSpecialFromDate());
        $to = strtotime($product->getSpecialToDate('special_to_date'));

        return $this->_checkDate($from, $to);
    }
    protected function _isOnPromotionPercent($product) {
        $valorPorcentagem = 0;
        if (($product->getPrice() - $product->getFinalPrice()) > 0) {
            $valorPorcentagem = round(((($product->getPrice() - $product->getFinalPrice()) / $product->getPrice()) * 100), 0);
        }
        return $valorPorcentagem;
    }
    protected function _isOnFreeShipping($product) {
        $FreeShipping = false;
        
        if (round($product->getPrice() - $product->getFinalPrice()) >= 200) {
            $FreeShipping = true;
        }

        return $FreeShipping;
    }
    protected function _checkDate($from, $to) {
        $today = strtotime(
                Mage::app()->getLocale()->date()
                        ->setTime('00:00:00')
                        ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT)
        );

        if ($from && $today < $from) {
            return false;
        }
        if ($to && $today > $to) {
            return false;
        }
        if (!$to && !$from) {
            return false;
        }
        return true;
    }
}