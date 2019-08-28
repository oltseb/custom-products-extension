<?php

namespace Oleksii\CustomProducts\Block\Adminhtml\Product\CustomNew;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Class SaveButton
 * @package Oleksii\CustomProducts\Block\Adminhtml\Product\CustomNew
 */
class SaveButton extends GenericButton implements ButtonProviderInterface
{

    /**
     * @return array
     */
    public function getButtonData()
    {
        
        return [
            'label' => __('Customly Save product'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save',
            ],
            'sort_order' => 90,
        ];
    }
}
