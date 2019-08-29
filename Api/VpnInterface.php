<?php

namespace Oleksii\CustomProducts\Api;

/**
 * Class ApiAbstract
 * @package Oleksii\CustomProducts\Api
 */
interface VpnInterface {

    /**
     *
     * @api
     * @param string $vpn VPN value
     * @return string
     */
    public function execute($vpn);
}