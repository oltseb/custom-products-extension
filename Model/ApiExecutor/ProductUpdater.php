<?php

namespace Oleksii\CustomProducts\Model\ApiExecutor;


use Magento\Framework\MessageQueue\PublisherInterface;
use Oleksii\CustomProducts\Api\MessageInterface;
use Oleksii\CustomProducts\Helper\MessageStorage;
use Psr\Log\LoggerInterface;
use Zend\Json\Json;

/**
 * Class ProductGetterVpn
 * @package Oleksii\CustomProducts\Api\Executor
 */
class ProductUpdater {

    const TOPIC_ARGUMENT = "customCatalog";

    /**
     * @var Json
     */
    protected $json;

    /**
     * @var MessageInterface
     */
    protected $message;

    /**
     * @var PublisherInterface
     */
    protected $publisher;

    /**
     * @var MessageStorage
     */
    protected $messageStorage;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * ProductUpdater constructor.
     * @param Json $json
     * @param MessageInterface $message
     * @param PublisherInterface $publisher
     * @param MessageStorage $messageStorage
     * @param LoggerInterface $logger
     */
    public function __construct(
        Json $json,
        MessageInterface $message,
        PublisherInterface $publisher,
        MessageStorage $messageStorage,
        LoggerInterface $logger
    )
    {
        $this->json = $json;
        $this->logger = $logger;
        $this->publisher = $publisher;
        $this->messageStorage = $messageStorage;
        $this->message = $message;
    }

    /**
     *
     * @api
     *
     * @param string $entity_id
     * @param string $copywrite_info
     * @param string $vpn
     * @return string|array
     */
    public function execute($entity_id, $copywrite_info, $vpn)
    {
        $message = [
            "entity_id" => $entity_id,
            "copy_write_info" => $copywrite_info,
            "vpn" => $vpn
        ];

        try {
            $this->message->setMessage($this->json->encode($message));
            $this->publisher->publish(self::TOPIC_ARGUMENT, $this->message);
        } catch(\Exception $e) {
            $this->logger->critical($e->getMessage());
            return $e->getMessage();
        }

        return $this->messageStorage::SUCCESS_MESSAGE;
    }
}