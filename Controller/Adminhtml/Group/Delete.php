<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Controller\Adminhtml\Group;

use CrazyCat\Banner\Model\Group;
use CrazyCat\Base\Controller\Adminhtml\AbstractDeleteAction;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Delete extends AbstractDeleteAction
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->delete(
            Group::class,
            'Specified group does not exist.',
            'Banner group deleted.'
        );
    }
}
