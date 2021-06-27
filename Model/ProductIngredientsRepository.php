<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model;

use DylanNgo\CustomProductAttribute\Api\Data\ProductIngredientsInterface;
use DylanNgo\CustomProductAttribute\Api\ProductIngredientsRepositoryInterface;
use DylanNgo\CustomProductAttribute\Model\ResourceModel\ProductIngredients\CollectionFactory;
use DylanNgo\CustomProductAttribute\Model\ResourceModel\ProductIngredients as ObjectResourceModel;
use DylanNgo\CustomProductAttribute\Model\ProductIngredientsFactory as ObjectModelFactory;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Class ProductIngredientsRepository
 * @package DylanNgo\CustomProductAttribute\Model
 */
class ProductIngredientsRepository implements ProductIngredientsRepositoryInterface
{
    private ObjectResourceModel $objectResourceModel;

    private ProductIngredientsFactory $objectModelFactory;

    private CollectionFactory $collectionFactory;

    /**
     * ProductIngredientsRepository constructor.
     * @param ObjectResourceModel $objectResourceModel
     * @param ProductIngredientsFactory $objectModelFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        ObjectResourceModel $objectResourceModel,
        ObjectModelFactory $objectModelFactory,
        CollectionFactory $collectionFactory
    )
    {
        $this->objectResourceModel = $objectResourceModel;
        $this->objectModelFactory = $objectModelFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param ProductIngredientsInterface $productIngredients
     * @return ProductIngredientsInterface
     * @throws CouldNotSaveException
     */
    public function save(ProductIngredientsInterface $productIngredients): ProductIngredientsInterface
    {
        try {
            $this->objectResourceModel->save($productIngredients);
            return $productIngredients;
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__($exception->getMessage()));
        }
    }

    /**
     * @param int $productId
     * @return array
     */
    public function getIngredientIds(int $productId): array
    {
        $batchSize = 1000;
        return $this->collectionFactory
            ->create()
            ->addFieldToSelect(['ingredient_id'])
            ->addFieldToFilter('product_id', ['eq' => $productId])
            ->setPageSize($batchSize)
            ->getItems();
    }

    /**
     * Delete By Product Id.
     *
     * @param int $productId
     */
    public function deleteByProductId(int $productId): void
    {
        $this->objectResourceModel->deleteByProductId($productId);
    }
}
