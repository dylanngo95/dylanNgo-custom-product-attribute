<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Class Ingredients
 * @package DylanNgo\CustomProductAttribute\Model\ResourceModel
 */
class Ingredients extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'ingredients_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('ingredients', 'entity_id');
        $this->_useIsObjectNew = true;
    }
}
