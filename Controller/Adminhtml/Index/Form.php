<?php

namespace Oleksii\CustomProducts\Controller\Adminhtml\Index;

/**
 * Class Form
 * @package Oleksii\CustomProducts\Controller\Adminhtml\Index
 */
class Form extends \Magento\Backend\App\Action
{

    /** @var string */
    const ADMIN_RESOURCE = 'Oleksii_CustomProducts::oleksii_custom_products_menu';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * NewAction constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory)
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
}
