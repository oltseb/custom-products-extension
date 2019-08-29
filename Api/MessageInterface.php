<?php

namespace Oleksii\CustomProducts\Api;

/**
 * Interface MessageInterface
 * @package Oleksii\CustomProducts\Api
 */
interface MessageInterface
{
    /**
     * @param string $message
     * @return void
     */
    public function setMessage($message);

    /**
     * @return string
     */
    public function getMessage();
}