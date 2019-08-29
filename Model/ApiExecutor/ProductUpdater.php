<?php

namespace Oleksii\CustomProducts\Model\ApiExecutor;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ProductGetterVpn
 * @package Oleksii\CustomProducts\Api\Executor
 */
class ProductUpdater extends AbstractExecutor {

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

        // TODO To be pushed further
        $this->json->encode($message);

        return $message;
    }
}