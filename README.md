# Custom Product Attribute
Module for add ingredients product attribute.

## How to install module
* Copy code to <project>/app/code/DylanNgo/CustomProductAttribute
* After that please run the command:
```bash
bin/magento module:enable DylanNgo_CustomProductAttribute
bin/magento module:status DylanNgo_CustomProductAttribute
```

## How to import ingredients
```bash
* Please run command to import ingredients sample data.
* Data will be on the table: ingredients

php bin/magento import:ingredients
```

## How to clean cache when add new data to the table: ingredients
```bash
php bin/magento cache:flush eav
```
