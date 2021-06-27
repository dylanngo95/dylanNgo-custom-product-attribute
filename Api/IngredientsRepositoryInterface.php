<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Api;


/**
 * Interface IngredientsRepositoryInterface
 * @package DylanNgo\CustomProductAttribute\Api
 */
interface IngredientsRepositoryInterface
{
    /**
     * @param Data\IngredientInterface $ingredient
     * @return Data\IngredientInterface
     */
    public function save(
        \DylanNgo\CustomProductAttribute\Api\Data\IngredientInterface $ingredient
    ): \DylanNgo\CustomProductAttribute\Api\Data\IngredientInterface;

    /**
     * @return \DylanNgo\CustomProductAttribute\Api\Data\IngredientInterface[]
     */
    public function getList(): array;
}
