<?php

namespace Oleksii\CustomProducts\Api;

/**
 *
 * Message subscriber interface
 *
 * Interface SubscriberInterface
 * @package Oleksii\CustomProducts\Api
 */
interface SubscriberInterface
{
    /**
     * @param \Oleksii\CustomProducts\Api\MessageInterface $message
     * @return void
     */
    public function processMessage(MessageInterface $message);
}
