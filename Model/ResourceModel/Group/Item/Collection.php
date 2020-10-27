<?php

namespace Common\Banner\Model\ResourceModel\Group\Item;

use Common\Base\Model\ResourceModel\AbstractStoreCollection;
use Common\Banner\Model\Group\Item;
use Common\Banner\Model\ResourceModel\Group\Item as ResourceItem;

class Collection extends AbstractStoreCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'banner_item_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'collection';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Item::class, ResourceItem::class);
    }
}
