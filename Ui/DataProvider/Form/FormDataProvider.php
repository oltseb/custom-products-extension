<?php
namespace Oleksii\CustomProducts\Ui\DataProvider\Form;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;

class FormDataProvider extends AbstractDataProvider
{

    /**
     * @var CollectionFactory
     */
    protected $collection;

    /**
     * @var array
     */
    protected $_loadedData;

    /**
     * FormDataProvider constructor.
     * @param $name
     * @param $primaryFieldName
     * @param $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return array
     */
    public function getData()
    {
        $this->_loadedData = [];

        if(isset($this->_loadedData)) {
            return $this->_loadedData;
        }

        $items = $this->collection->getItems();

        foreach($items as $product)
        {
            $this->_loadedData[$product->getId()] = $product->getData();
        }

        return $this->_loadedData;
    }

}
