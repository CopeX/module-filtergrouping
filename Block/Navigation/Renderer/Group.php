<?php

namespace CopeX\FilterGrouping\Block\Navigation\Renderer;

use Magento\Catalog\Model\Layer\Filter\FilterInterface;
use Magento\Framework\View\Element\Template;
use Magento\LayeredNavigation\Block\Navigation\FilterRendererInterface;



class Group extends Template implements FilterRendererInterface
{
    /**
     * @var FilterInterface
     */
    private $filter;

    /**
     * @var string
     */
    protected $block = \CopeX\FilterGrouping\Block\Navigation\Renderer\Group\Render::class;

    /**
     * {@inheritDoc}
     */
    protected function canRenderFilter()
    {
        return $this->getFilter() instanceof \CopeX\FilterGrouping\Model\Layer\Filter\Group;
    }

    /**
     * @SuppressWarnings(PHPMD.CamelCaseMethodName)
     *
     * {@inheritDoc}
     */
    protected function _toHtml()
    {
        $html = false;

        if ($this->canRenderFilter()) {
            $html = $this->getLayout()
                ->createBlock($this->block)
                ->setRenderer($this->getParentBlock())
                ->setItems($this->getFilter()->getItems())
                ->toHtml();
        }

        return $html;
    }

    /**
     * {@inheritDoc}
     */
    public function render(FilterInterface $filter)
    {
        $html         = '';
        $this->filter = $filter;

        if ($this->canRenderFilter()) {
            $this->assign('filterItems', $filter->getItems());
            $html = $this->_toHtml();
            $this->assign('filterItems', []);
        }

        return $html;
    }

    /**
     * @return FilterInterface
     */
    public function getFilter()
    {
        return $this->filter;
    }

}
