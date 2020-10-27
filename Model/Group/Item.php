<?php

namespace Common\Banner\Model\Group;

use Common\Base\Model\AbstractStoreModel;

class Item extends AbstractStoreModel
{
    /**
     * {@inheritDoc}
     */
    protected function _construct()
    {
        $this->_init(\Common\Banner\Model\ResourceModel\Group\Item::class);
    }
}
