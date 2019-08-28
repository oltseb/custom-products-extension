<?php

namespace Oleksii\CustomProducts\Helper;

use Magento\Framework\Controller\Result\JsonFactory;

/**
 * Class MessageServer
 * @package Oleksii\CustomProducts\Helper
 */
class MessageServer {

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    public function __construct(
        JsonFactory $jsonFactory
    )
    {
        $this->jsonFactory = $jsonFactory;
    }

    public function packMessage($messages, $error) {
        $resultJson = $this->jsonFactory->create();
        return $resultJson->setData([
            "messages" => $messages,
            "error" => $error
        ]);
    }

}