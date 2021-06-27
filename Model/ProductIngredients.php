<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model;

use DylanNgo\CustomProductAttribute\Api\Data\ProductIngredientsInterface;
use DylanNgo\CustomProductAttribute\Model\ResourceModel\ProductIngredients as ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class ProductIngredients
 * @package DylanNgo\CustomProductAttribute\Model
 */
class ProductIngredients extends AbstractModel implements ProductIngredientsInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'product_ingredients_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(ResourceModel::class);
    }

    /**
     * @inheritDoc
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID) === null ? null
            : (int)$this->getData(self::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setEntityId($entityId)
    {
        $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * @inheritDoc
     */
    public function getIngredientId(): ?int
    {
        return $this->getData(self::INGREDIENT_ID) === null ? null
            : (int)$this->getData(self::INGREDIENT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setIngredientId(?int $ingredientId): void
    {
        $this->setData(self::INGREDIENT_ID, $ingredientId);
    }

    /**
     * @inheritDoc
     */
    public function getProductId(): ?int
    {
        return $this->getData(self::PRODUCT_ID) === null ? null
            : (int)$this->getData(self::PRODUCT_ID);
    }

    /**
     * @inheritDoc
     */
    public function setProductId(?int $productId): void
    {
        $this->setData(self::PRODUCT_ID, $productId);
    }

    /**
     * @inheritDoc
     */
    public function getCreatedAt(): ?string
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setCreatedAt(?string $createdAt): void
    {
        $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * @inheritDoc
     */
    public function getUpdatedAt(): ?string
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @inheritDoc
     */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->setData(self::UPDATED_AT, $updatedAt);
    }
}
