<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Controller\Adminhtml\Group;

use CrazyCat\Banner\Model\Group;
use CrazyCat\Base\Controller\Adminhtml\AbstractSaveAction;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Save extends AbstractSaveAction
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->save(
            Group::class,
            'Specified group does not exist.',
            'Banner group saved successfully.',
            'banner_group'
        );
    }
}
