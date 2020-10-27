<?php

namespace Common\Banner\Model\ResourceModel\Group\Grid;

use Common\Base\Model\ResourceModel\Grid\AbstractCollection;
use Common\Banner\Model\ResourceModel\Group as ResourceGroup;
use Common\Banner\Model\ResourceModel\Group\Collection as GroupCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;

class Collection extends GroupCollection implements SearchResultInterface
{
    use AbstractCollection;

    /**
     * @var string
     */
    protected $_eventPrefix = 'menu_menu_grid_collection';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Document::class, ResourceGroup::class);
    }
}
