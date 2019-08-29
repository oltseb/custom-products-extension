<?php

namespace Oleksii\CustomProducts\Model\ApiExecutor;


use Magento\Framework\MessageQueue\PublisherInterface;
use Oleksii\CustomProducts\Api\MessageInterface;
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
     * ProductUpdater constructor.
     * @param Json $json
     * @param MessageInterface $message
     * @param PublisherInterface $publisher
     */
    public function __construct(
        Json $json,
        MessageInterface $message,
        PublisherInterface $publisher
    )
    {
        $this->json = $json;
        $this->publisher = $publisher;
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
            return $e->getMessage();
        }

        //TODO check the string to be moved somewhere
        return "Message was published";
    }
}