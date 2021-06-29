<?php

namespace DylanNgo\CustomProductAttribute\Ui\Component\Form;

use Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider;

/**
 * DataProvider component.
 */
class Ingredients extends DataProvider
{
    /**
     * @inheritDoc
     */
    public function getData()
    {
        //TODO: implement data retrieving here based on search criteria
        return [
            []
        ];
    }
}
