<?php

namespace Oleksii\CustomProducts\Controller\Adminhtml\Index;

/**
 * Class Index
 * @package Oleksii\CustomProducts\Controller\Adminhtml\Index
 */
class Index extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Oleksii_CustomProducts::oleksii_custom_products_menu';

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Index constructor.
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
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Custom Catalog')));

        return $resultPage;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return parent::_isAllowed('Oleksii_CustomProducts::menu');
    }
}
