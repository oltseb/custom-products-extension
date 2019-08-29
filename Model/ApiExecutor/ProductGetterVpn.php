<?php

namespace Oleksii\CustomProducts\Model\ApiExecutor;

/**
 * Class ProductGetterVpn
 * @package Oleksii\CustomProducts\Api\Executor
 */
class ProductGetterVpn extends AbstractExecutor {

    /**
     *
     * @api
     * @param string $vpn VPN value
     * @return array
     */
    public function execute($vpn)
    {
        $collection = $this->collectionFactory->create();
        $collection ->addAttributeToSelect("*")
                    ->addAttributeToFilter('vpn', $vpn)
                    ->load();
        $items = $collection->getItems();
        $response = array();

        foreach ($items as $item) {
            foreach ($item->getData() as $key => $value) {
                $response[$item->getData("entity_id")][$key] = $value;
            }
        }

        return $response;
    }
}