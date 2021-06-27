<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Api\Data;

/**
 * Interface IngredientInterface
 * @package DylanNgo\CustomProductAttribute\Api\Data
 */
interface IngredientInterface
{
    /**
     * String constants for property names
     */
    const ENTITY_ID = "entity_id";
    const VALUE = "value";
    const POSITION = "position";
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
     * Getter for Value.
     *
     * @return string|null
     */
    public function getValue(): ?string;

    /**
     * Setter for Value.
     *
     * @param string|null $value
     *
     * @return void
     */
    public function setValue(?string $value): void;

    /**
     * Getter for Position.
     *
     * @return int|null
     */
    public function getPosition(): ?int;

    /**
     * Setter for Position.
     *
     * @param int|null $position
     *
     * @return void
     */
    public function setPosition(?int $position): void;

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
