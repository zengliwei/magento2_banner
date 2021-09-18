<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Model\Group;

use CrazyCat\Base\Model\AbstractStoreModel;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Item extends AbstractStoreModel
{
    public const MEDIA_FOLDER = 'banner';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(\CrazyCat\Banner\Model\ResourceModel\Group\Item::class);
    }
}
