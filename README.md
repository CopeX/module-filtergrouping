# Mage2 Module CopeX FilterGrouping

    ``copex/module-filtergrouping``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation)
 - [Configuration](#markdown-header-configuration)
 - [Specifications](#markdown-header-specifications)
 - [Attributes](#markdown-header-attributes)


## Main Functionalities
Ability to group filters in the layered navigation 

## Installation

### Type 1: Zip file

 - Unzip the zip file in `app/code/CopeX`
 - Enable the module by running `php bin/magento module:enable CopeX_FilterGrouping`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require copex/module-filtergrouping`
 - enable the module by running `php bin/magento module:enable CopeX_FilterGrouping`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`


## Configuration

Go To: Stores -> Configuration -> Catalog -> Attribute Grouping
- Name: The name that is displayed as group label in storefront (can be translated)
- Attributes: Comma separated list of attribute codes that should be grouped together

Possiblilty to create 10 groups


## Specifications

 - Plugin
	- afterGetFilters - Magento\Catalog\Model\Layer\FilterList > CopeX\FilterGrouping\Plugin\Frontend\Magento\Catalog\Mode\Layer\Filter
    - aroundRender - Magento\LayeredNavigation\Block\Navigation\FilterRenderer > CopeX\FilterGrouping\Plugin\FilterRenderer
    