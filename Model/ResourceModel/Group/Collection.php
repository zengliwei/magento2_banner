<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Model\ResourceModel\Group;

use CrazyCat\Banner\Model\Group;
use CrazyCat\Banner\Model\ResourceModel\Group as ResourceGroup;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'id';

    /**
     * @var string
     */
    protected $_eventPrefix = 'banner_group_collection';

    /**
     * @var string
     */
    protected $_eventObject = 'collection';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(Group::class, ResourceGroup::class);
    }
}
