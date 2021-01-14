<?php
/**
 * Copyright ©  All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types = 1);

namespace CopeX\FilterGrouping\Plugin\Frontend\Magento\Catalog\Model\Layer;

use CopeX\FilterGrouping\Model\Layer\Filter\GroupFactory;
use Magento\Catalog\Model\Layer\FilterList;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

class Filter
{
    const COPEX_FILTER_GROUPING = 'copex_filter_grouping';

    /**
     * @var array
     */
    protected $storeConfig = null;
    /**
     * @var GroupFactory
     */
    private $groupFactory;
    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(GroupFactory $groupFactory, ScopeConfigInterface $scopeConfig)
    {
        $this->groupFactory = $groupFactory;
        $this->scopeConfig = $scopeConfig;
    }

    public function afterGetFilters(
        FilterList $subject,
        $result
    ) {
        $this->initConfig();
        $groupedFilters = $this->getGroupedFilters($result);

        foreach ($groupedFilters as $groupName => $groupedFilter) {
            reset($groupedFilter);
            $firstFilterKey = key($groupedFilter);
            foreach (array_slice(array_keys($groupedFilter),1) as $blockKey ) {
                unset($result[$blockKey]);
            }
            $result[$firstFilterKey] = $this->groupFactory->create(
                [
                    'data' => [
                        'items' => $groupedFilter,
                        'name'  => $this->getLabel($groupName),
                    ],
                ]);
        }
        return $result;
    }

    public function getGroupedFilters($result): array
    {
        $groupedFilters = [];
        foreach ($result as $blockKey => $filter) {
            foreach ($this->storeConfig as $name => $attributeCode) {
                if ($filter->getData('attribute_model') &&
                    in_array($filter->getAttributeModel()->getAttributeCode(), $attributeCode) ) {
                    $groupedFilters[$name][$blockKey] = $filter;
                }
            }
        }
        return $groupedFilters;
    }

    public function getLabel( $groupName)
    {
        return __($groupName);
    }

    public function getConfig(){
        return $this->scopeConfig->getValue(self::COPEX_FILTER_GROUPING,
            ScopeInterface::SCOPE_STORE);
    }

    public function initConfig(){
        if($this->storeConfig === null){
            $this->storeConfig = [];
            foreach ($this->getConfig() ?? [] as $group) {
                if (isset($group['name']) && isset($group['attributes']) && $group['attributes'] ) {
                    $this->storeConfig[$group['name']] = array_map("trim", explode(",",trim($group['attributes'])));
                }
            }
        }
        return $this->storeConfig;
    }
}

