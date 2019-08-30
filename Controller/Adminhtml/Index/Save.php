<?php

namespace Oleksii\CustomProducts\Controller\Adminhtml\Index;

use Magento\Framework\Controller\Result\Json;
use Oleksii\CustomProducts\Helper\MessageStorage;
use Oleksii\CustomProducts\Model\CustomProductHandler;

/**
 * Class InlineEdit
 * @package Oleksii\CustomProducts\Controller\Adminhtml\Index
 */
class Save extends ActionAbstract
{

    /**
     * @var CustomProductHandler
     */
    protected $customProductHandler;

    /**
     * @var MessageStorage
     */
    protected $messageStorage;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param CustomProductHandler $customProductHandler
     * @param MessageStorage $messageStorage
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        CustomProductHandler $customProductHandler,
        MessageStorage $messageStorage
    )
    {
        $this->customProductHandler = $customProductHandler;
        $this->messageStorage = $messageStorage;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|Json|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {

            if (empty($data['sku'])) {
                $this->messageManager->addErrorMessage($this->messageStorage::NO_SKU_MESSAGE);
                return $resultRedirect->setPath('*/*/form');
            }

            $result = $this->customProductHandler->handleCustomProductsData($data);

            if (!is_bool($result)) {
                $this->messageManager->addErrorMessage($result->getMessage());
                return $resultRedirect->setPath('*/*/form');
            }
        }

        $this->messageManager->addSuccessMessage($this->messageStorage::SUCCESS_MESSAGE);
        return $resultRedirect->setPath('*/*/');
    }
}
