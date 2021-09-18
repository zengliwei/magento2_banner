<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Controller\Adminhtml\Item;

use CrazyCat\Banner\Model\Group\Item;
use CrazyCat\Base\Controller\Adminhtml\AbstractEditAction;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Edit extends AbstractEditAction
{
    public const ADMIN_RESOURCE = 'CrazyCat_Banner::banner_item';

    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->render(
            Item::class,
            'Specified item does not exist.',
            'CrazyCat_Banner::banner_item',
            'Create Banner Item',
            'Edit Banner Item (ID: %1)'
        );
    }
}
