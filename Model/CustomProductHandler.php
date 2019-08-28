<?php

namespace Oleksii\CustomProducts\Model;

use Magento\Catalog\Model\AbstractModel;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class CustomProduct
 * @package Oleksii\CustomProducts\Model
 */
class CustomProductHandler extends AbstractModel {

    const ENTITY_FIELD = "entity_id";

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * CustomProductHandler constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory
     * @param AttributeValueFactory $customAttributeFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param ProductRepository $productRepository
     * @param ProductFactory $productFactory
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context, 
        \Magento\Framework\Registry $registry, 
        \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory, 
        AttributeValueFactory $customAttributeFactory, 
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        ProductRepository $productRepository,
        ProductFactory $productFactory,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null, 
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        parent::__construct(
            $context, 
            $registry, 
            $extensionFactory, 
            $customAttributeFactory, 
            $storeManager, 
            $resource, 
            $resourceCollection, 
            $data
        );
    }

    /**
     * Function to save updated products from custom catalog
     *
     * @param array $items
     * @return \Exception|NoSuchEntityException
     */
    public function saveCustomProducts(array $items) {

        foreach ($items as $item) {
            /**
             * Attempt to load the product
             */
            try {
                $product = $this->productRepository->getById($item[self::ENTITY_FIELD]);
            } catch (NoSuchEntityException $e) {
                return $e;
            }

            foreach ($item as $key => $value) {
                $product->setData($key, $value);
            }

            /**
             * Save of the product
             */
            try {
                $this->productRepository->save($product);
            } catch (\Exception $e) {
                return $e;
            }
        }
    }

    public function createCustomProducts(array $data) {

        $product = $this->productFactory->create($data);

        foreach ($data as $key => $value) {
            if ($key === "form_key") {
                continue;
            }
            $product->setData($key, $value);
        }

        /**
         * Since other was not declared -
         * Let's assume that out target is to create product of constant types
         * Otherwise, we are missing required values for the Product Model
         */
        $product->setName("CustomCatalogProduct_" . $product->getSku());
        $product->setTypeId('simple');
        $product->setAttributeSetId(4);
        $product->setWebsiteIds(array(1));
        $product->setVisibility(4);
        $product->setPrice(array(1));
        $this->productRepository->save($product);
    }
}