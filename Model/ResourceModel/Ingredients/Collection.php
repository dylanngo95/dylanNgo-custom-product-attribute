<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model\ResourceModel\Ingredients;

use DylanNgo\CustomProductAttribute\Model\Ingredients as Model;
use DylanNgo\CustomProductAttribute\Model\ResourceModel\Ingredients as ResourceModel;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * Class Collection
 * @package DylanNgo\CustomProductAttribute\Model\ResourceModel\Ingredients
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'ingredients_collection';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
