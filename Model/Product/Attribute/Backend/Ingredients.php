<?php

declare(strict_types=1);

namespace  DylanNgo\CustomProductAttribute\Model\Product\Attribute\Backend;

use DylanNgo\CustomProductAttribute\Model\ProductIngredientsRepository;

/**
 * Class Ingredients
 * @package DylanNgo\CustomProductAttribute\Model\Product\Attribute\Backend
 */
class Ingredients extends \Magento\Eav\Model\Entity\Attribute\Backend\AbstractBackend
{
    /**
     * Set category ids to product data
     *
     * @param \Magento\Catalog\Model\Product $object
     * @return $this
     */
    public function afterLoad($object)
    {
        $object->setData($this->getAttribute()->getAttributeCode(), $object->getIngredients());
        return parent::afterLoad($object);
    }
}
