<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Observer;

use DylanNgo\CustomProductAttribute\Api\Data\ProductIngredientsInterfaceFactory;
use DylanNgo\CustomProductAttribute\Model\ProductIngredientsRepository;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

/**
 * Class SaveProductObserver
 * @package DylanNgo\CustomProductAttribute\Observer
 */
class SaveProductObserver implements ObserverInterface
{
    private ProductIngredientsRepository $productIngredientsRepository;
    private ProductIngredientsInterfaceFactory $productIngredientsInterfaceFactory;

    public function __construct(
        ProductIngredientsRepository $productIngredientsRepository,
        ProductIngredientsInterfaceFactory $productIngredientsInterfaceFactory
    ) {
        $this->productIngredientsRepository = $productIngredientsRepository;
        $this->productIngredientsInterfaceFactory = $productIngredientsInterfaceFactory;
    }

    /**
     * @param Observer $observer
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute(Observer $observer)
    {
        $product = $observer->getProduct();
        $ingredientsIds = $product->getIngredients() ?? [];
        $productId = (int) $product->getId();
        if (!count($ingredientsIds)) {
            $this->productIngredientsRepository->deleteByProductId($productId);
            return;
        }
        $this->productIngredientsRepository->deleteByProductId($productId);
        foreach ($ingredientsIds as $ingredientsId) {
            $productIngredient = $this->productIngredientsInterfaceFactory->create();
            $productIngredient->setProductId($productId);
            $productIngredient->setIngredientId((int) $ingredientsId);
            $this->productIngredientsRepository->save($productIngredient);
        }
    }
}
