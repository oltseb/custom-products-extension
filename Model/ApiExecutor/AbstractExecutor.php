<?php

namespace Oleksii\CustomProducts\Model\ApiExecutor;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Zend\Json\Json;

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
     * @var Json
     */
    protected $json;

    /**
     *
     */
    protected $configOptionsListTest;

    /**
     * AbstractExecutor constructor.
     * @param CollectionFactory $collectionFactory
     * @param Json $json
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        Json $json
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->json = $json;
    }

}