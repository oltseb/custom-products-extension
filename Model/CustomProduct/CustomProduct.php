<?php

namespace Oleksii\CustomProducts\Model\CustomProduct;

use Magento\Catalog\Model\AbstractModel;
use Magento\Catalog\Model\ProductFactory;
use Magento\Catalog\Model\ProductRepository;
use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Oleksii\CustomProducts\Helper\MessageStorage;
use Psr\Log\LoggerInterface;

/**
 * Class CustomProduct
 * @package Oleksii\CustomProducts\Model
 */
class CustomProduct extends AbstractModel
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
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var MessageStorage
     */
    protected $messageStorage;

    /**]
     * CustomProduct constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Api\ExtensionAttributesFactory $extensionFactory
     * @param AttributeValueFactory $customAttributeFactory
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param ProductRepository $productRepository
     * @param ProductFactory $productFactory
     * @param LoggerInterface $logger
     * @param MessageStorage $messageStorage
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
        LoggerInterface $logger,
        MessageStorage $messageStorage,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [])
    {
        $this->productRepository = $productRepository;
        $this->productFactory = $productFactory;
        $this->logger = $logger;
        $this->messageStorage = $messageStorage;
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
     * @return \Exception|NoSuchEntityException|bool
     */
    public function updateCustomProducts(array $items)
    {

        foreach ($items as $item) {

            /**
             * Attempt to load the product
             */
            try {
                $product = $this->productRepository->getById($item[self::ENTITY_FIELD]);
            } catch (NoSuchEntityException $e) {
                $this->logger->critical($e->getMessage());
                return $e;
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
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
                $this->logger->critical($e->getMessage());
                return $e;
            }
        }

        return true;
    }

    /**
     * @param array $data
     * @return \Exception|bool
     */
    public function createCustomProducts(array $data)
    {

        try {
            $product = $this->productRepository->get($data[self::SKU_FIELD]);
        } catch (NoSuchEntityException $e) {
            $product = false;
        }

        if ($product) {
            return new \Exception($this->messageStorage::SKU_ALREADY_EXISTS);
        }

        $product = $this->productFactory->create($data);

        foreach ($data as $key => $value) {
            if ($key === "form_key") {
                continue;
            }
            $product->setData($key, $value);
        }

        $this->fillRequiredValues($product);

        try {
            $this->productRepository->save($product);
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
            return $e;
        }

        return true;
    }

    /**
     * @param $product
     * @return mixed
     */
    protected function fillRequiredValues($product)
    {

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
        $product->setPrice(5);

        return $product;
    }
}