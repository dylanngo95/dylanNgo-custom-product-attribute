<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model;

use DylanNgo\CustomProductAttribute\Api\Data\IngredientInterface;
use DylanNgo\CustomProductAttribute\Model\ResourceModel\Ingredients as ResourceModel;
use Magento\Framework\Model\AbstractModel;

/**
 * Class Ingredients
 * @package DylanNgo\CustomProductAttribute\Model
 */
class Ingredients extends AbstractModel implements IngredientInterface
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'ingredients_model';

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
    public function getValue(): ?string
    {
        return $this->getData(self::VALUE);
    }

    /**
     * @inheritDoc
     */
    public function setValue(?string $value): void
    {
        $this->setData(self::VALUE, $value);
    }

    /**
     * @inheritDoc
     */
    public function getPosition(): ?int
    {
        return $this->getData(self::POSITION) === null ? null
            : (int)$this->getData(self::POSITION);
    }

    /**
     * @inheritDoc
     */
    public function setPosition(?int $position): void
    {
        $this->setData(self::POSITION, $position);
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
