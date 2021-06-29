<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Block\Adminhtml\Block\Edit;

use DylanNgo\CustomProductAttribute\Model\IngredientsRepository;
use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected Context $context;

    /**
     * @var IngredientsRepository
     */
    private IngredientsRepository $ingredientsRepository;

    /**
     * @param Context $context
     * @param IngredientsRepository $ingredientsRepository
     */
    public function __construct(
        Context $context,
        IngredientsRepository $ingredientsRepository
    ) {
        $this->context = $context;
        $this->ingredientsRepository = $ingredientsRepository;
    }

    /**
     * @return int|null
     */
    public function getIngredientsId(): ?int
    {
        try {
            return $this->ingredientsRepository->getById(
                $this->context->getRequest()->getParam('entity_id')
            )->getId();
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param string $route
     * @param array $params
     * @return  string
     */
    public function getUrl(string $route = '', array $params = []): string
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
