<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Plugin\Catalog\Product;

use Magento\Catalog\Model\Product;

/**
 * Class Helper
 * @package DylanNgo\CustomProductAttribute\Plugin\Catalog\Product
 */
class Helper
{
    /**
     * @param \Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper $subject
     * @param Product $product
     * @param array $productData
     * @return array
     */
    public function beforeInitializeFromData(
        \Magento\Catalog\Controller\Adminhtml\Product\Initialization\Helper $subject,
        Product $product,
        array $productData
    ) {
        foreach (['ingredients'] as $field) {
            if (!isset($productData[$field])) {
                $productData[$field] = [];
            }
        }
        return [$product, $productData];
    }
}
