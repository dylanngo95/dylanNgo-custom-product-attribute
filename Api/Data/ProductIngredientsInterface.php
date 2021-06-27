<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Api\Data;

/**
 * Interface ProductIngredientsInterface
 * @package DylanNgo\CustomProductAttribute\Api\Data
 */
interface ProductIngredientsInterface
{
    /**
     * String constants for property names
     */
    const ENTITY_ID = "entity_id";
    const INGREDIENT_ID = "ingredient_id";
    const PRODUCT_ID = "product_id";
    const CREATED_AT = "created_at";
    const UPDATED_AT = "updated_at";

    /**
     * Getter for EntityId.
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Setter for EntityId.
     *
     * @param int|null $entityId
     *
     * @return void
     */
    public function setEntityId($entityId);

    /**
     * Getter for IngredientId.
     *
     * @return int|null
     */
    public function getIngredientId(): ?int;

    /**
     * Setter for IngredientId.
     *
     * @param int|null $ingredientId
     *
     * @return void
     */
    public function setIngredientId(?int $ingredientId): void;

    /**
     * Getter for ProductId.
     *
     * @return int|null
     */
    public function getProductId(): ?int;

    /**
     * Setter for ProductId.
     *
     * @param int|null $productId
     *
     * @return void
     */
    public function setProductId(?int $productId): void;

    /**
     * Getter for CreatedAt.
     *
     * @return string|null
     */
    public function getCreatedAt(): ?string;

    /**
     * Setter for CreatedAt.
     *
     * @param string|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?string $createdAt): void;

    /**
     * Getter for UpdatedAt.
     *
     * @return string|null
     */
    public function getUpdatedAt(): ?string;

    /**
     * Setter for UpdatedAt.
     *
     * @param string|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?string $updatedAt): void;
}
