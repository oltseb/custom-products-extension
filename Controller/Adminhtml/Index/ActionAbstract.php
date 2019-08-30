<?php

namespace Oleksii\CustomProducts\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;

/**
 * Class ActionAbstract
 * @package Oleksii\CustomProducts\Controller\Adminhtml\Index
 */
abstract class ActionAbstract extends Action {

    const ADMIN_RESOURCE = 'Oleksii_CustomProducts::oleksii_custom_products_menu';

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return parent::_isAllowed('Oleksii_CustomProducts::menu');
    }

}