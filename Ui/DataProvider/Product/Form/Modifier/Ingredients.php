<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Ui\DataProvider\Product\Form\Modifier;

use DylanNgo\CustomProductAttribute\Api\Data\IngredientInterface;
use DylanNgo\CustomProductAttribute\Model\IngredientsRepository;
use Magento\Catalog\Model\Locator\LocatorInterface;
use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\AbstractModifier;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Framework\Stdlib\ArrayManager;
use Magento\Framework\AuthorizationInterface;
use Magento\Backend\Model\Auth\Session;


/**
 * Class Categories
 * @package Magento\Catalog\Ui\DataProvider\Product\Form\Modifier
 */
class Ingredients extends AbstractModifier
{
    const CATALOG_PRODUCT_INGREDIENTS = 'CATALOG_PRODUCT_INGREDIENTS';

    /**
     * @var LocatorInterface
     * @since 101.0.0
     */
    protected LocatorInterface $locator;

    /**
     * @var ArrayManager
     * @since 101.0.0
     */
    protected ArrayManager $arrayManager;

    /**
     * @var CacheInterface
     */
    private CacheInterface $cacheManager;

    /**
     * @var SerializerInterface
     */
    private SerializerInterface $serializer;

    /**
     * @var AuthorizationInterface
     */
    private AuthorizationInterface $authorization;

    /**
     * @var Session
     */
    private Session $session;

    /**
     * @var IngredientsRepository
     */
    private IngredientsRepository $ingredientsRepository;

    /**
     * @param LocatorInterface $locator
     * @param ArrayManager $arrayManager
     * @param SerializerInterface $serializer
     * @param AuthorizationInterface $authorization
     * @param Session $session
     * @param IngredientsRepository $ingredientsRepository
     * @param CacheInterface $cacheManager
     */
    public function __construct(
        LocatorInterface $locator,
        ArrayManager $arrayManager,
        SerializerInterface $serializer,
        AuthorizationInterface $authorization,
        Session $session,
        IngredientsRepository $ingredientsRepository,
        CacheInterface $cacheManager
    )
    {
        $this->locator = $locator;
        $this->arrayManager = $arrayManager;
        $this->serializer = $serializer;
        $this->authorization = $authorization;
        $this->session = $session;
        $this->ingredientsRepository = $ingredientsRepository;
        $this->cacheManager = $cacheManager;
    }

    /**
     * @inheritdoc
     * @since 101.0.0
     */
    public function modifyMeta(array $meta)
    {
        if ($this->isAllowed()) {
            $this->customizeIngredientsField($meta);
        }
        return $meta;
    }

    /**
     * Check current user permission on category resource
     *
     * @return bool
     */
    private function isAllowed(): bool
    {
        return (bool)$this->authorization->isAllowed('DylanNgo_CustomProductAttribute::ingredients');
    }

    /**
     * @inheritdoc
     * @since 101.0.0
     */
    public function modifyData(array $data)
    {
        return $data;
    }

    /**
     * @param array $meta
     * @return array
     */
    protected function customizeIngredientsField(array $meta): array
    {
        $fieldCode = 'ingredients';
        $elementPath = $this->arrayManager->findPath($fieldCode, $meta, null, 'children');
        $containerPath = $this->arrayManager->findPath(
            static::CONTAINER_PREFIX . $fieldCode, $meta,
            null,
            'children'
        );
        $fieldIsDisabled = $this->locator->getProduct()->isLockedAttribute($fieldCode);

        if (!$elementPath) {
            return $meta;
        }

        $value = [
            'arguments' => [
                'data' => [
                    'config' => [
                        'label' => false,
                        'required' => false,
                        'dataScope' => '',
                        'breakLine' => false,
                        'formElement' => 'container',
                        'componentType' => 'container',
                        'component' => 'Magento_Ui/js/form/components/group',
                        'disabled' => $fieldIsDisabled,
                    ],
                ],
            ],
            'children' => [
                $fieldCode => [
                    'arguments' => [
                        'data' => [
                            'config' => [
                                'formElement' => 'select',
                                'componentType' => 'field',
                                'component' => 'Magento_Catalog/js/components/new-category',
                                'filterOptions' => true,
                                'chipsEnabled' => true,
                                'disableLabel' => true,
                                'levelsVisibility' => '1',
                                'disabled' => $fieldIsDisabled,
                                'elementTmpl' => 'ui/grid/filters/elements/ui-select',
                                'options' => $this->getIngredients(),
                                'listens' => [
                                    'index=create_category:responseData' => 'setParsed',
                                    'newOption' => 'toggleOptionSelected'
                                ],
                                'config' => [
                                    'dataScope' => $fieldCode,
                                    'sortOrder' => 10,
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ];
        $meta = $this->arrayManager->merge($containerPath, $meta, $value);

        return $meta;
    }

    /**
     * @param null $filter
     * @return array
     */
    protected function getIngredients($filter = null): array
    {
        $storeId = (int)$this->locator->getStore()->getId();

        $cachedIngredient = $this->cacheManager->load($this->getCacheId($storeId, (string)$filter));
        if (!empty($cachedIngredient)) {
            return $this->serializer->unserialize($cachedIngredient);
        }

        $ingredients = $this->ingredientsRepository->getList();
        $data = [];
        foreach ($ingredients as $ingredient) {
            /** @var IngredientInterface $ingredient */
            $data[] = [
                'value' => (string)$ingredient->getEntityId(),
                'is_active' => '1',
                'label' => __($ingredient->getValue()),
                '__disableTmpl' => true,
            ];
        }

        $this->cacheManager->save(
            $this->serializer->serialize($data),
            $this->getCacheId($storeId, (string)$filter),
            [
                \Magento\Catalog\Model\Category::CACHE_TAG,
                \Magento\Framework\App\Cache\Type\Block::CACHE_TAG
            ]
        );

        return $data;
    }

    /**
     * Get Cache Id.
     *
     * @param int $storeId
     * @param string $filter
     * @return string
     */
    private function getCacheId(int $storeId, string $filter = ''): string
    {
        if ($this->session->getUser() !== null) {
            return self::CATALOG_PRODUCT_INGREDIENTS
                . '_' . (string)$storeId
                . '_' . $this->session->getUser()->getAclRole()
                . '_' . $filter;
        }
        return self::CATALOG_PRODUCT_INGREDIENTS
            . '_' . (string)$storeId
            . '_' . $filter;
    }

    /**
     * @return array[]
     */
    protected function getOptions()
    {
        return [
            [
                'value' => '1',
                'is_active' => '1',
                'label' => __('alcohol extract'),
                '__disableTmpl' => true,
            ],
            [
                'value' => '3',
                'is_active' => '1',
                'label' => __('alcohol certified organic'),
                '__disableTmpl' => true,
            ],
            [
                'value' => '2',
                'label' => __('banana'),
                'is_active' => '1',
                '__disableTmpl' => true,
            ],
            [
                'value' => '4',
                'label' => __('aloe leaf extract'),
                'is_active' => '1',
                '__disableTmpl' => true,
            ],
            [
                'value' => '5',
                'label' => __('adobe'),
                'is_active' => '1',
                '__disableTmpl' => true,
            ],
            [
                'value' => '6',
                'label' => __('apple'),
                'is_active' => '1',
                '__disableTmpl' => true,
            ],
            [
                'value' => '17',
                'label' => __('corona'),
                'is_active' => '1',
                '__disableTmpl' => true,
            ],
        ];
    }

}
