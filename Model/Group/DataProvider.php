<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Model\Group;

use CrazyCat\Banner\Model\ResourceModel\Group\Collection;
use CrazyCat\Base\Model\AbstractDataProvider;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class DataProvider extends AbstractDataProvider
{
    /**
     * @var string
     */
    protected $persistKey = 'banner_group';

    /**
     * @inheritDoc
     */
    protected function init()
    {
        $this->initCollection(Collection::class);
    }
}
