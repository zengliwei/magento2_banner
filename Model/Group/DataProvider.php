<?php

namespace Common\Banner\Model\Group;

use Common\Base\Model\AbstractDataProvider;
use Common\Banner\Model\ResourceModel\Group\Collection;

class DataProvider extends AbstractDataProvider
{
    protected $persistKey = 'banner_group';

    /**
     * @inheritDoc
     */
    protected function init()
    {
        $this->initCollection(Collection::class);
    }
}
