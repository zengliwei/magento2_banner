<?php

namespace Common\Banner\Model;

use Magento\Framework\Model\AbstractModel;

class Group extends AbstractModel
{
    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\Group::class);
    }
}
