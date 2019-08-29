<?php

namespace Oleksii\CustomProducts\Model\ApiExecutor;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

/**
 * Class ProductGetterVpn
 * @package Oleksii\CustomProducts\Api\Executor
 */
class ProductGetterVpn {

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * AbstractExecutor constructor.
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
    }

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