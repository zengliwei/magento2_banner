<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Controller\Adminhtml\Group;

use CrazyCat\Base\Controller\Adminhtml\AbstractIndexAction;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Index extends AbstractIndexAction
{
    public const ADMIN_RESOURCE = 'CrazyCat_Banner::banner_group';

    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->render(
            'banner_group',
            'CrazyCat_Banner::banner_group',
            'Banner Groups'
        );
    }
}
