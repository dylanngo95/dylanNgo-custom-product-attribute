<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model;


use DylanNgo\CustomProductAttribute\Api\Data\IngredientInterface;
use DylanNgo\CustomProductAttribute\Api\IngredientsRepositoryInterface;
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

    public function __construct(
        ObjectResourceModel $objectResourceModel,
        CollectionFactory $collectionFactory
    )
    {
        $this->collectionFactory = $collectionFactory;
        $this->objectResourceModel = $objectResourceModel;
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
        } catch (\Exception $e){
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

}
