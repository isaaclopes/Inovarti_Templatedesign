<?php
/**
 *
 * @category   Inovarti
 * @package    Inovarti_Templatedesign
 * @author     Suporte <suporte@inovarti.com.br>
 */

class Inovarti_Templatedesign_Model_Config_Zoom_Position
{

    public function toOptionArray()
    {
        return array(
            array(
	            'value'=>'top',
	            'label' => Mage::helper('templatedesign')->__('Top')),
            array(
	            'value'=>'right',
	            'label' => Mage::helper('templatedesign')->__('Right')),
            array(
	            'value'=>'bottom',
	            'label' => Mage::helper('templatedesign')->__('Bottom')),
            array(
	            'value'=>'left',
	            'label' => Mage::helper('templatedesign')->__('Left')),
            array(
	            'value'=>'inside',
	            'label' => Mage::helper('templatedesign')->__('Inside')),
        );
    }

}
