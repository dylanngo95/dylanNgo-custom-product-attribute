<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model\ResourceModel\ProductIngredients;

use DylanNgo\CustomProductAttribute\Model\ProductIngredients as Model;
use DylanNgo\CustomProductAttribute\Model\ResourceModel\ProductIngredients as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package DylanNgo\CustomProductAttribute\Model\ResourceModel\ProductIngredients
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'product_ingredients_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
