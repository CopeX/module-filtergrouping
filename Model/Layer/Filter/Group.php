<?php
/**
 * Group
 * @copyright Copyright © 2021 CopeX GmbH. All rights reserved.
 * @author    andreas.pointner@copex.io
 */

namespace CopeX\FilterGrouping\Model\Layer\Filter;

use Magento\Catalog\Model\Layer\Filter\FilterInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\DataObject;

class Group extends DataObject implements FilterInterface
{

    /**
     * @inheridoc
     */
    public function setRequestVar($varName)
    {
    }

    /**
     * @inheridoc
     */
    public function getRequestVar()
    {
    }

    /**
     * @inheridoc
     */
    public function getResetValue()
    {
    }

    /**
     * @inheridoc
     */
    public function getCleanValue()
    {
    }

    /**
     * @inheridoc
     */
    public function apply(RequestInterface $request)
    {
        /** @var FilterInterface $item */
        foreach ($this->getItems() ?? [] as $item) {
            $item->apply($request);
        }
    }

    /**
     * @inheridoc
     */
    public function getItemsCount()
    {
        return array_reduce($this->getItems(), function ($value, $item) {
            $value += $item->getItemsCount();
            return $value;
        });
    }

    /**
     * @inheridoc
     */
    public function getItems()
    {
        return $this->getData('items');
    }

    /**
     * @inheridoc
     */
    public function setItems(array $items)
    {
        $this->setData('items', $items);
    }

    /**
     * @inheridoc
     */
    public function getLayer()
    {
        return $this->getData('layer');
    }

    /**
     * @inheridoc
     */
    public function setAttributeModel($attribute)
    {
    }

    /**
     * @inheridoc
     */
    public function getAttributeModel()
    {
        return null;
    }

    /**
     * @inheridoc
     */
    public function getName()
    {
        return $this->getData('name');
    }

    /**
     * @inheridoc
     */
    public function getStoreId()
    {
    }

    /**
     * @inheridoc
     */
    public function setStoreId($storeId)
    {
    }

    /**
     * @inheridoc
     */
    public function getWebsiteId()
    {
    }

    /**
     * @inheridoc
     */
    public function setWebsiteId($websiteId)
    {
    }

    /**
     * @inheridoc
     */
    public function getClearLinkText()
    {
    }
}