<?php

namespace Oleksii\CustomProducts\Api;

/**
 *
 * Interface for get by VPN API
 *
 * Class ApiAbstract
 * @package Oleksii\CustomProducts\Api
 */
interface VpnInterface {

    /**
     *
     * @api
     * @param string $vpn VPN value
     * @return array
     */
    public function execute($vpn);
}
