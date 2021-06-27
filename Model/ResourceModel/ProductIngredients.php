<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductIngredients extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'product_ingredients_resource_model';

    /**
     * @inheritdoc
     */
    protected function _construct()
    {
        $this->_init('product_ingredients', 'entity_id');
        $this->_useIsObjectNew = true;
    }

    /**
     * Delete By Product Id.
     *
     * @param int $productId
     * @return int
     */
    public function deleteByProductId(int $productId): int
    {
        $table = $this->_resources->getTableName('product_ingredients');
        return $this
            ->getConnection()
            ->delete($table, ['product_id=?' => $productId]);
    }
}
