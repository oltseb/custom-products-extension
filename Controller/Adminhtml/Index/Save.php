<?php

namespace Oleksii\CustomProducts\Controller\Adminhtml\Index;

use Oleksii\CustomProducts\Model\CustomProductHandler;

/**
 * Class InlineEdit
 * @package Oleksii\CustomProducts\Controller\Adminhtml\Index
 */
class Save extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Oleksii_CustomProducts::oleksii_custom_products_menu';

    /**
     * @var CustomProductHandler
     */
    protected $customProductHandler;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param CustomProductHandler $customProductHandler
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        CustomProductHandler $customProductHandler
    )
    {
        $this->customProductHandler = $customProductHandler;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {

            if (empty($data['sku'])) {
                return $resultRedirect->setPath('*/*/form');
            }

            $this->customProductHandler->createCustomProducts($data);
        }

        return $resultRedirect->setPath('*/*/');
    }
}
