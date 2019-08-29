<?php

namespace Oleksii\CustomProducts\Model\ApiExecutor;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

/**
 * Class AbstractExecutor
 * @package Oleksii\CustomProducts\Model\ApiExecutor
 */
abstract class AbstractExecutor {

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

}