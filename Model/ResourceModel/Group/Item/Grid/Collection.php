<?php

namespace Common\Banner\Model\ResourceModel\Group\Item\Grid;

use Common\Base\Model\ResourceModel\Grid\AbstractCollection;
use Common\Banner\Model\ResourceModel\Group\Item as ResourceItem;
use Common\Banner\Model\ResourceModel\Group\Item\Collection as ItemCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;

class Collection extends ItemCollection implements SearchResultInterface
{
    use AbstractCollection;

    /**
     * @var string
     */
    protected $_eventPrefix = 'menu_item_grid_collection';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Document::class, ResourceItem::class);
    }
}
