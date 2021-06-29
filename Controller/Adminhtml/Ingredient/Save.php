<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Controller\Adminhtml\Ingredient;

use DylanNgo\CustomProductAttribute\Model\IngredientsFactory;
use DylanNgo\CustomProductAttribute\Model\IngredientsRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

/**
 * Class Save
 * @package DylanNgo\CustomProductAttribute\Controller\Adminhtml\Ingredient
 */
class Save extends Action implements HttpPostActionInterface
{
    /**
     * Authorization level of a basic admin session
     */
    const ADMIN_RESOURCE = 'DylanNgo_CustomProductAttribute::ingredients_save';

    private IngredientsRepository $ingredientsRepository;

    private IngredientsFactory $ingredientsFactory;

    private DataPersistorInterface $dataPersistor;

    /**
     * Save constructor.
     * @param Context $context
     * @param IngredientsFactory $ingredientsFactory
     * @param IngredientsRepository $ingredientsRepository
     * @param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        Context $context,
        IngredientsFactory $ingredientsFactory,
        IngredientsRepository $ingredientsRepository,
        DataPersistorInterface $dataPersistor
    ) {
        parent::__construct($context);
        $this->ingredientsRepository = $ingredientsRepository;
        $this->ingredientsFactory = $ingredientsFactory;
        $this->dataPersistor = $dataPersistor;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if (!isset($data['value'])) {
            return $resultRedirect->setPath('*/*/');
        }

        $value = $data['value'];
        $position = $data['position'] ? (int) $data['position'] : 0;

        $ingredient = $this->ingredientsFactory->create();

        $id = (int) $this->getRequest()->getParam('entity_id');
        if ($id) {
            $ingredient = $this->ingredientsRepository->getById($id);
        }

        try {
            $ingredient->setValue($value);
            $ingredient->setPosition($position);
            $this->ingredientsRepository->save($ingredient);

            $this->messageManager->addSuccessMessage(__('You saved the ingredients.'));
            $this->dataPersistor->clear('ingredients');

            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $ex) {
            $this->messageManager->addErrorMessage($ex->getMessage());
        }

        return $resultRedirect->setPath('*/*/');
    }
}
