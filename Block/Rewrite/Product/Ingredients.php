<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Block\Rewrite\Product;

use DylanNgo\CustomProductAttribute\Model\IngredientsRepository;
use Magento\Catalog\Model\Product;
use Magento\Framework\Registry;
use Magento\Framework\View\Element\Template\Context;

/**
 * Class Description
 * @package Magento\Catalog\Block\Product\View
 */
class Ingredients extends \Magento\Framework\View\Element\Template
{
    /**
     * @var Product
     */
    protected $_product = null;

    /**
     * Core registry
     *
     * @var Registry
     */
    protected $_coreRegistry = null;

    /**
     * @var IngredientsRepository
     */
    private $ingredientsRepository;

    /**
     * @param Context $context
     * @param Registry $registry
     * @param array $data
     * @param IngredientsRepository $ingredientsRepository
     */
    public function __construct(
        Context $context,
        Registry $registry,
        array $data = [],
        IngredientsRepository $ingredientsRepository
    ) {
        $this->_coreRegistry = $registry;
        $this->ingredientsRepository = $ingredientsRepository;
        parent::__construct($context, $data);
    }

    /**
     * @return Product
     */
    public function getProduct(): Product
    {
        if (!$this->_product) {
            $this->_product = $this->_coreRegistry->registry('product');
        }
        return $this->_product;
    }

    /**
     * @return array
     */
    public function getIngredientsValue(): array
    {
        $ids = $this->getProduct()->getData('ingredients') ?? [];
        return $this->ingredientsRepository->getByIds($ids);
    }
}
