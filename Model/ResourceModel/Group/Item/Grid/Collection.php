<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Model\ResourceModel\Group\Item\Grid;

use CrazyCat\Banner\Model\ResourceModel\Group\Item as ResourceItem;
use CrazyCat\Banner\Model\ResourceModel\Group\Item\Collection as ItemCollection;
use CrazyCat\Base\Model\ResourceModel\Grid\AbstractCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Collection extends ItemCollection implements SearchResultInterface
{
    use AbstractCollection;

    /**
     * @var string
     */
    protected $_eventPrefix = 'menu_item_grid_collection';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(Document::class, ResourceItem::class);
    }
}
