<?php

namespace Common\Banner\Model\ResourceModel\Group;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Item extends AbstractDb
{
    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init('banner_item', 'id');
    }
}
