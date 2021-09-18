<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Model\ResourceModel\Group\Grid;

use CrazyCat\Banner\Model\ResourceModel\Group as ResourceGroup;
use CrazyCat\Banner\Model\ResourceModel\Group\Collection as GroupCollection;
use CrazyCat\Base\Model\ResourceModel\Grid\AbstractCollection;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\View\Element\UiComponent\DataProvider\Document;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Collection extends GroupCollection implements SearchResultInterface
{
    use AbstractCollection;

    /**
     * @var string
     */
    protected $_eventPrefix = 'menu_menu_grid_collection';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(Document::class, ResourceGroup::class);
    }
}
