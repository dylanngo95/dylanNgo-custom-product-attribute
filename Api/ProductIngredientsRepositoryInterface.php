<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Api;


/**
 * Class ProductIngredientsRepositoryInterface
 * @package DylanNgo\CustomProductAttribute\Api
 */
interface ProductIngredientsRepositoryInterface
{
    /**
     * @param \DylanNgo\CustomProductAttribute\Api\Data\ProductIngredientsInterface $productIngredients
     * @return \DylanNgo\CustomProductAttribute\Api\Data\ProductIngredientsInterface
     */
    public function save(
        \DylanNgo\CustomProductAttribute\Api\Data\ProductIngredientsInterface $productIngredients
    ): \DylanNgo\CustomProductAttribute\Api\Data\ProductIngredientsInterface;

    /**
     * @param int $productId
     * @return array
     */
    public function getIngredientIds(int $productId): array;

    /**
     * @param int $productId
     * @return void
     */
    public function deleteByProductId(int $productId): void;

}
