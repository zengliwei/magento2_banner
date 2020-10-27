<?php

namespace Common\Banner\Model\Group\Item;

use Common\Base\Model\AbstractDataProvider;
use Common\Banner\Model\ResourceModel\Group\Item\Collection;

class DataProvider extends AbstractDataProvider
{
    protected $persistKey = 'banner_item';

    /**
     * @inheritDoc
     */
    protected function init()
    {
        $this->initCollection(Collection::class);
    }
}
