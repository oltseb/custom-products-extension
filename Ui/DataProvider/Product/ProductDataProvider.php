<?php

namespace Oleksii\CustomProducts\Ui\DataProvider\Product;

use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;

/**
 * Class ProductDataProvider
 * @package Oleksii\CustomProducts\Ui\DataProvider\Product
 */
class ProductDataProvider extends AbstractDataProvider
{

    /**
     * @var $collectionFactory
     */
    protected $collectionFactory;

    /**
     * ProductDataProvider constructor.
     * @param CollectionFactory $collectionFactory
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        CollectionFactory $collectionFactory,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create()
            ->addAttributeToSelect('*');
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $items = $this->getCollection()->toArray();

        $data = [
            'totalRecords' => $this->getCollection()->getSize(),
            'items' => array_values($items),
        ];

        return $data;
    }

}