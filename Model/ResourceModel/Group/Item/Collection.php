<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Model\ResourceModel\Group\Item;

use CrazyCat\Banner\Model\Group\Item;
use CrazyCat\Banner\Model\ResourceModel\Group\Item as ResourceItem;
use CrazyCat\Base\Model\ResourceModel\AbstractStoreCollection;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
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
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(Item::class, ResourceItem::class);
    }
}
