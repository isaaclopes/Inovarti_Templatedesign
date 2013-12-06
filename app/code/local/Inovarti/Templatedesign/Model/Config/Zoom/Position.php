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
	            'value'=>'right',
	            'label' => Mage::helper('templatedesign')->__('Right')),
            array(
	            'value'=>'inside',
	            'label' => Mage::helper('templatedesign')->__('Inside')),
        );
    }

}
