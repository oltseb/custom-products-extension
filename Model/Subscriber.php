<?php

namespace Oleksii\CustomProducts\Model;

use Oleksii\CustomProducts\Api\MessageInterface;
use Oleksii\CustomProducts\Api\SubscriberInterface;
use Zend\Json\Json;

/**
 * Class Subscriber
 * @package Oleksii\CustomProducts\Model
 */
class Subscriber implements SubscriberInterface
{

    /**
     * @var CustomProductHandler
     */
    protected $productHandler;

    /**
     * @var Json
     */
    protected $json;

    /**
     * Subscriber constructor.
     * @param CustomProductHandler $productHandler
     * @param Json $json
     */
    public function __construct(
        CustomProductHandler $productHandler,
        Json $json
    )
    {
        $this->productHandler = $productHandler;
        $this->json = $json;
    }

    /**
     * {@inheritdoc}
     */
    public function processMessage(MessageInterface $message)
    {
        $data = array();
        $data[] = $this->json->decode($message->getMessage(), $this->json::TYPE_ARRAY);
        $this->productHandler->handleCustomProductsData($data);
    }
}