<?php

namespace Oleksii\CustomProducts\Controller\Adminhtml\Index;

use Magento\Framework\Controller\Result\JsonFactory;
use Oleksii\CustomProducts\Helper\MessageStorage;
use Oleksii\CustomProducts\Model\CustomProductHandler;
use Psr\Log\LoggerInterface;

/**
 * Class InlineEdit
 * @package Oleksii\CustomProducts\Controller\Adminhtml\Index
 */
class InlineEdit extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Oleksii_CustomProducts::oleksii_custom_products_menu';

    /**
     * @var MessageStorage
     */
    protected $messageStorage;

    /**
     * @var
     */
    protected $customProductHandler;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * InlineEdit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param MessageStorage $messageStorage
     * @param CustomProductHandler $customProductHandler
     * @param JsonFactory $jsonFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        MessageStorage $messageStorage,
        CustomProductHandler $customProductHandler,
        JsonFactory $jsonFactory,
        LoggerInterface $logger
    )
    {
        $this->messageStorage = $messageStorage;
        $this->jsonFactory = $jsonFactory;
        $this->customProductHandler = $customProductHandler;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {

        $error = false;
        $resultJson = $this->jsonFactory->create();
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {

            $items = $this->getRequest()->getParams()['items'];

            if (is_array($items)) {

                try {
                    $this->customProductHandler->saveCustomProducts($items);
                    $messages = $this->messageStorage::SUCCESS_MESSAGE;
                } catch (\Exception $e) {
                    $this->logger->critical($e->getMessage());
                    $messages = $e->getMessage();
                    $error = true;
                }

            } else {
                $messages = $this->messageStorage::ERROR_MESSAGE;
                $error = true;
            }
        }

        return $resultJson->setData([
            "messages" => $messages,
            "error" => $error
        ]);
    }
}
