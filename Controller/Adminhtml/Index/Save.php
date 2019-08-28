<?php

namespace Oleksii\CustomProducts\Controller\Adminhtml\Index;

use Magento\Framework\Controller\Result\JsonFactory;
use Oleksii\CustomProducts\Helper\MessageServer;
use Oleksii\CustomProducts\Model\CustomProductHandler;

/**
 * Class InlineEdit
 * @package Oleksii\CustomProducts\Controller\Adminhtml\Index
 */
class Save extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Oleksii_CustomProducts::oleksii_custom_products_menu';
    const ERROR_MESSAGE = 'Ooops! Something went wrong. Please try again';
    const SUCCESS_MESSAGE = 'All good';

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var MessageServer
     */
    protected $messageServer;

    /**
     * @var CustomProductHandler
     */
    protected $customProductHandler;

    /**
     * Save constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param JsonFactory $jsonFactory
     * @param MessageServer $messageServer
     * @param CustomProductHandler $customProductHandler
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        JsonFactory $jsonFactory,
        MessageServer $messageServer,
        CustomProductHandler $customProductHandler
    )
    {
        $this->jsonFactory = $jsonFactory;
        $this->messageServer = $messageServer;
        $this->customProductHandler = $customProductHandler;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|MessageServer
     */
    public function execute()
    {


        $resultRedirect = $this->resultRedirectFactory->create();

        $data = $this->getRequest()->getPostValue();

        if ($data) {

            if (empty($data['product_id'])) {
                $data['product_id'] = null;
            }

            $this->customProductHandler->createCustomProducts($data);
        }

        return $resultRedirect->setPath('*/*/form');
    }
}
