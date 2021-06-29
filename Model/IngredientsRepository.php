<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model;

use DylanNgo\CustomProductAttribute\Api\Data\IngredientInterface;
use DylanNgo\CustomProductAttribute\Api\IngredientsRepositoryInterface;
use DylanNgo\CustomProductAttribute\Model\IngredientsFactory as ObjectModelFactory;
use DylanNgo\CustomProductAttribute\Model\ResourceModel\Ingredients as ObjectResourceModel;
use DylanNgo\CustomProductAttribute\Model\ResourceModel\Ingredients\CollectionFactory;
use Magento\Framework\Exception\CouldNotSaveException;

/**
 * Class IngredientsRepository
 * @package DylanNgo\CustomProductAttribute\Model
 */
class IngredientsRepository implements IngredientsRepositoryInterface
{
    private CollectionFactory $collectionFactory;
    private ObjectResourceModel $objectResourceModel;
    private IngredientsFactory $objectModelFactory;

    public function __construct(
        ObjectResourceModel $objectResourceModel,
        ObjectModelFactory $objectModelFactory,
        CollectionFactory $collectionFactory
    ) {
        $this->objectResourceModel = $objectResourceModel;
        $this->objectModelFactory = $objectModelFactory;
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @param IngredientInterface $ingredient
     * @return IngredientInterface
     * @throws CouldNotSaveException
     */
    public function save(IngredientInterface $ingredient): IngredientInterface
    {
        try {
            $this->objectResourceModel->save($ingredient);
            return $ingredient;
        } catch (\Exception $e) {
            throw new CouldNotSaveException(__($e->getMessage()));
        }
    }

    /**
     * @param int $batchSize
     * @return array
     */
    public function getList(int $batchSize = 1000): array
    {
        return $this->collectionFactory
            ->create()
            ->setPageSize($batchSize)
            ->getItems();
    }

    /**
     * @param array $ids
     * @param int $batchSize
     * @return array
     */
    public function getByIds(array $ids, int $batchSize = 1000): array
    {
        return $this->collectionFactory
            ->create()
            ->addFieldToFilter('entity_id', ['in' => $ids])
            ->addFieldToSelect(['value'])
            ->setPageSize($batchSize)
            ->getItems();
    }

    /**
     * Get By Id.
     *
     * @param int $id
     * @return IngredientInterface
     */
    public function getById(int $id): ?IngredientInterface
    {
        $object = $this->objectModelFactory->create();
        $this->objectResourceModel->load($object, $id);
        if (!$object->getEntityId()) {
            return null;
        }
        return $object;
    }
}
