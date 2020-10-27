<?php

namespace Common\Banner\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Group extends AbstractDb
{
    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init('banner_group', 'id');
    }
}
