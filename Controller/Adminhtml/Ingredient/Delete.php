<?php

declare(strict_types=1);

namespace DylanNgo\CustomProductAttribute\Controller\Adminhtml\Ingredient;

use DylanNgo\CustomProductAttribute\Model\IngredientsFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;

/**
 * Delete CMS block action.
 */
class Delete extends Action implements HttpPostActionInterface
{

    /**
     * Authorization level of a basic admin session
     *
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'DylanNgo_CustomProductAttribute::ingredients_delete';

    protected PageFactory $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param IngredientsFactory $ingredientsFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        IngredientsFactory $ingredientsFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->ingredientsFactory = $ingredientsFactory;
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     * @return \Magento\Backend\Model\View\Result\Page
     */
    protected function initPage($resultPage)
    {
        $resultPage->setActiveMenu('DylanNgo_CustomProductAttribute::listing')
            ->addBreadcrumb(__('Ingredients'), __('Ingredients'))
            ->addBreadcrumb(__('Delete'), __('Delete'));
        return $resultPage;
    }

    /**
     * Edit CMS block
     *
     * @return \Magento\Framework\Controller\ResultInterface
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        $id = $this->getRequest()->getParam('entity_id');
        if (!$id) {
            $this->messageManager->addErrorMessage(__('We can\'t find a ingredients to delete.'));
            return $resultRedirect->setPath('*/*/');
        }

        try {
            $model = $this->ingredientsFactory->create();
            $model->load($id);
            $model->delete();
            $this->messageManager->addSuccessMessage(__('You deleted the ingredients.'));
            return $resultRedirect->setPath('*/*/');
        } catch (\Exception $ex) {
            $this->messageManager->addErrorMessage($ex->getMessage());
            return $resultRedirect->setPath('*/*/edit', ['entity_id' => $id]);
        }
    }
}
