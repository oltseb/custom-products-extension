<?php

namespace Oleksii\CustomProducts\Model;

use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Exception\NoSuchEntityException;
use Oleksii\CustomProducts\Model\CustomProduct\CustomProduct;

/**
 * Class CustomProduct
 * @package Oleksii\CustomProducts\Model
 */
class CustomProductHandler
{

    const ENTITY_FIELD = "entity_id";
    const SKU_FIELD = "sku";

    /**
     * @var ProductRepository
     */
    protected $productRepository;

    /**
     * @var ProductFactory
     */
    protected $productFactory;

    /**
     * @var CustomProduct
     */
    protected $customProduct;

    /**
     * CustomProductHandler constructor.
     * @param ProductRepository $productRepository
     * @param ProductFactory $productFactory
     * @param CustomProduct $customProduct
     */
    public function __construct(
        ProductRepository $productRepository,
        ProductFactory $productFactory,
        CustomProduct $customProduct)
    {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        $this->customProduct = $customProduct;
    }

    /**
     *
     * Handler of the save/update logic for custom product
     *
     * @param array $data
     * @return bool|\Exception|NoSuchEntityException
     */
    public function handleCustomProductsData(array $data) {

        /**
         * Data from inline edit is arriving as a composite array, thus no sku or entity_id set on the first level
         * Entity_id can be set in the put api
         * Sku can be set when creating the product from admin
         */
        if (isset($data[self::SKU_FIELD]) || isset($deta[self::ENTITY_FIELD])) {
            return $this->customProduct->createCustomProducts($data);
        }
        return $this->customProduct->updateCustomProducts($data);
    }

}