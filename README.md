# Custom Product Attribute
Module for add ingredients product attribute.

## How to install module
* Make sure the module running on Magento 2.4.2, php7.4
* Copy code to <project>/app/code/DylanNgo/CustomProductAttribute
* After that please run the command:
```bash
bin/magento module:enable DylanNgo_CustomProductAttribute
bin/magento module:status DylanNgo_CustomProductAttribute
```

## How to add ingredient
* Go to: Admin page
* Go to: Catalogs -> Ingredients
* Click to button: Add New Ingredient
* Enter information -> Click to button: Save

## How to import ingredients
```bash
* Please run command to import ingredients sample data.
* Data will be on the table: ingredients

php bin/magento import:ingredients
```
