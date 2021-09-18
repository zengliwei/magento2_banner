<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Controller\Adminhtml\Group;

use CrazyCat\Banner\Model\Group;
use CrazyCat\Base\Controller\Adminhtml\AbstractEditAction;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Edit extends AbstractEditAction
{
    public const ADMIN_RESOURCE = 'CrazyCat_Banner::banner_group';

    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->render(
            Group::class,
            'Specified group does not exist.',
            'CrazyCat_Banner::banner_group',
            'Create Group',
            'Edit Group (ID: %1)'
        );
    }
}
