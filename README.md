# MageGuide AttributeOptionsSort
Tested on: ```2.3+```
## Description
Adds new CLI Command (mageguide:sort:options) that takes an argument (any multiselect product attribute) and sorts the attribute's options alphabetically.

## Functionalities 
- Console Command
	- SortAlpabetically

## Steps to setup / use as *Usage
- Upload module files in ``app/code/MageGuide/AttributeOptionsSort``
- Install module
```sh
        $ php bin/magento module:enable MageGuide_AttributeOptionsSort
        $ php bin/magento setup:upgrade
        $ php bin/magento setup:di:compile
```
- Run CLI Command
```sh
        $ php bin/magento mageguide:sort:options -o "<attribute_name>"
```

## Screenshots
Magento Admin Sorted Options

![Alt text](/Screenshots/admin-sorted-options.png?raw=true)