<?php

namespace Common\Banner\Controller\Adminhtml\Group;

use Common\Base\Controller\Adminhtml\AbstractIndexAction;

class Index extends AbstractIndexAction
{
    public const ADMIN_RESOURCE = 'Common_Banner::banner_group';

    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->render(
            'banner_group',
            'Common_Banner::banner_group',
            'Banner Groups'
        );
    }
}
