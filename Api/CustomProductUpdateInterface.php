<?php

namespace Oleksii\CustomProducts\Api;

/**
 * Class ApiAbstract
 * @package Oleksii\CustomProducts\Api
 */
interface CustomProductUpdateInterface {

    /**
     *
     * @api
     *
     * @param string $entity_id
     * @param string $copywrite_info
     * @param string $vpn
     * @return void|string
     */
    public function execute($entity_id, $copywrite_info, $vpn);
}