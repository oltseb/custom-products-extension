<?php

namespace Oleksii\CustomProducts\Controller\Adminhtml\Index;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * Class Form
 * @package Oleksii\CustomProducts\Controller\Adminhtml\Index
 */
class Form extends \Magento\Backend\App\Action
{

    /** @var string */
    const ADMIN_RESOURCE = 'Oleksii_CustomProducts::oleksii_custom_products_menu';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * NewAction constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return parent::_isAllowed('Oleksii_CustomProducts::menu');
    }
}
