<?php

/**
 *
 * @category   Inovarti
 * @package    Inovarti_Templatedesign
 * @author     Suporte <suporte@inovarti.com.br>
 */
class Inovarti_Templatedesign_Helper_Image extends Mage_Core_Helper_Abstract
{
    protected $_defaultWidth = 736;
    protected $_defaultHeight = 460;
    protected $_mainWidth;
    protected $_mainHeight;
    protected $_aspect;
    protected $_config;

    public function __construct(){
        $this->_mainWidth = $this->_defaultWidth;
        $this->_mainHeight = $this->_defaultHeight;

        $this->_config = Mage::getStoreConfig('templatedesign');

        if ($this->_config['images']['width'] > 0) {
            $this->_mainWidth = intval($this->_config['images']['width']);
            $this->_mainHeight = intval($this->_config['images']['width']);
        }
        if ($this->_config['images']['height'] > 0) {
            $this->_mainHeight = intval($this->_config['images']['height']);
        }

        $this->_aspect = $this->_mainWidth / $this->_mainHeight;
    }

    public function calculateHeight($width)
    {
        if ($this->_config['images']['keep_ratio']) {
            return round($width / $this->_aspect);
        } else {
            return round($width / ($this->_defaultWidth / $this->_defaultHeight));
        }
    }
}