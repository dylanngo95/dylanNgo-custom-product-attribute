<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model\Product;

use DylanNgo\CustomProductAttribute\Model\ProductIngredientsRepository;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;

/**
 * Class ReadHandler
 * @package DylanNgo\CustomProductAttribute\Model\Product
 */
class ReadHandler implements ExtensionInterface
{
    private ProductIngredientsRepository $productIngredientsRepository;

    /**
     * ReadHandler constructor.
     * @param ProductIngredientsRepository $productIngredientsRepository
     */
    public function __construct(
        ProductIngredientsRepository $productIngredientsRepository
    )
    {
        $this->productIngredientsRepository = $productIngredientsRepository;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return \Magento\Catalog\Api\Data\ProductInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($entity, $arguments = [])
    {
        /** @var $entity \Magento\Catalog\Api\Data\ProductInterface */
        $productId = (int) $entity->getId();
        $ingredientIds = $this->productIngredientsRepository->getIngredientIds($productId);

        $ingredientIdData = [];
        foreach ($ingredientIds as $ingredientId) {
            $ingredientIdData[] = (string) $ingredientId->getIngredientId();
        }
        $entity->setData('ingredients', $ingredientIdData);
        return $entity;
    }
}
