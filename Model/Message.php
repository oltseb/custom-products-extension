<?php

namespace Oleksii\CustomProducts\Model;

use Oleksii\CustomProducts\Api\MessageInterface;

/**
 * Class Message
 * @package Oleksii\CustomProducts\Model
 */
class Message implements MessageInterface
{
    /**
     * @var string
     */
    protected $message;

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    public function setMessage($message)
    {
        return $this->message = $message;
    }
}