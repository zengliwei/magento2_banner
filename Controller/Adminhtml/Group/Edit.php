<?php

namespace Common\Banner\Controller\Adminhtml\Group;

use Common\Base\Controller\Adminhtml\AbstractEditAction;
use Common\Banner\Model\Group;

class Edit extends AbstractEditAction
{
    public const ADMIN_RESOURCE = 'Common_Banner::banner_group';

    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->render(
            Group::class,
            'Specified group does not exist.',
            'Common_Banner::banner_group',
            'Create Group',
            'Edit Group (ID: %1)'
        );
    }
}
