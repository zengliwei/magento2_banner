<?php

namespace Common\Banner\Model\ResourceModel\Group;

use Common\Banner\Model\Group;
use Common\Banner\Model\ResourceModel\Group as ResourceGroup;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

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
     * @return void
     */
    protected function _construct()
    {
        $this->_init(Group::class, ResourceGroup::class);
    }
}
