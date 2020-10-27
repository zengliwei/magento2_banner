<?php

namespace Common\Banner\Controller\Adminhtml\Item;

use Common\Base\Controller\Adminhtml\AbstractEditAction;
use Common\Banner\Model\Group\Item;

class Edit extends AbstractEditAction
{
    public const ADMIN_RESOURCE = 'Common_Banner::banner_item';

    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->render(
            Item::class,
            'Specified item does not exist.',
            'Common_Banner::banner_item',
            'Create Banner Item',
            'Edit Banner Item (ID: %1)'
        );
    }
}
