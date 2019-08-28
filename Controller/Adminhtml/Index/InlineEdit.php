<?php

namespace Oleksii\CustomProducts\Controller\Adminhtml\Index;

use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Oleksii\CustomProducts\Helper\MessageServer;
use Oleksii\CustomProducts\Model\CustomProductSaver;

/**
 * Class InlineEdit
 * @package Oleksii\CustomProducts\Controller\Adminhtml\Index
 */
class InlineEdit extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Oleksii_CustomProducts::oleksii_custom_products_menu';
    const ERROR_MESSAGE = 'Ooops! Something went wrong. Please try again';
    const SUCCESS_MESSAGE = 'All good';

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var MessageServer
     */
    protected $messageServer;

    /**
     * @var
     */
    protected $customProductSaver;

    /**
     * InlineEdit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param JsonFactory $jsonFactory
     * @param ProductRepository $productRepository
     * @param MessageServer $messageServer
     * @param CustomProductSaver $customProductSaver
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        JsonFactory $jsonFactory,
        ProductRepository $productRepository,
        MessageServer $messageServer,
        CustomProductSaver $customProductSaver
    )
    {
        $this->productRepository = $productRepository;
        $this->jsonFactory = $jsonFactory;
        $this->messageServer = $messageServer;
        $this->customProductSaver = $customProductSaver;
        parent::__construct($context);
    }


    public function execute()
    {
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {

            $items = $this->getRequest()->getParams()['items'];

            if (is_array($items)) {

                try {
                    $this->customProductSaver->saveCustomProducts($items);
                    $messages = $this::SUCCESS_MESSAGE;
                } catch (\Exception $e) {
                    $messages = $e->getMessage();
                    $error = true;
                }

            } else {
                $messages = self::ERROR_MESSAGE;
                $error = true;
            }
        }

        return $this->messageServer->packMessage($messages, $error);
    }
}