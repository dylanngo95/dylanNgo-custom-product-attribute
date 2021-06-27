<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Setup\Patch\Data;

use Magento\Catalog\Block\Adminhtml\Product\Helper\Form\Category as CategoryFormHelper;
use DylanNgo\CustomProductAttribute\Model\Product\Attribute\Backend\Ingredients as IngredientsBackendAttribute;
use Magento\Catalog\Setup\CategorySetup;
use Magento\Catalog\Setup\CategorySetupFactory;
use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Framework\Setup\Patch\PatchVersionInterface;
use Zend_Validate_Exception;


/**
 * Class UpdateProductAttributesPatch
 * @package QT\CustomProductAttribute\Setup\Patch\Data
 */
class ProductAttributePatch implements DataPatchInterface, PatchVersionInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    private $moduleDataSetup;

    /**
     * @var CategorySetupFactory
     */
    private $categorySetupFactory;

    /**
     * PatchInitial constructor.
     * @param ModuleDataSetupInterface $moduleDataSetup
     * @param CategorySetupFactory $categorySetupFactory
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup,
        CategorySetupFactory $categorySetupFactory
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
        $this->categorySetupFactory = $categorySetupFactory;
    }

    /**
     * @return void
     * @throws LocalizedException
     * @throws Zend_Validate_Exception
     */
    public function apply()
    {
        /** @var CategorySetup $categorySetup */
        $categorySetup = $this->categorySetupFactory->create(['setup' => $this->moduleDataSetup]);

        $attributeSetId = $categorySetup
            ->getDefaultAttributeSetId(\Magento\Catalog\Model\Product::ENTITY);
        $categorySetup->addAttribute(
            \Magento\Catalog\Model\Product::ENTITY,
            'ingredients',
            [
                'type' => 'static',
                'label' => 'Ingredients',
                'global' => ScopedAttributeInterface::SCOPE_GLOBAL,
                'backend' => IngredientsBackendAttribute::class,
                'input_renderer' => CategoryFormHelper::class,
                'required' => false,
                'sort_order' => 9,
                'visible' => true,
                'group' => 'General',
                'is_used_in_grid' => false,
                'is_visible_in_grid' => false,
                'is_filterable_in_grid' => false,
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public static function getDependencies()
    {
        return [
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function getVersion()
    {
        return '1.0.0';
    }

    /**
     * {@inheritdoc}
     */
    public function getAliases()
    {
        return [];
    }
}
