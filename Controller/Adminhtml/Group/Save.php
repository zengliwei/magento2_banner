<?php

namespace Common\Banner\Controller\Adminhtml\Group;

use Common\Base\Controller\Adminhtml\AbstractSaveAction;
use Common\Banner\Model\Group;

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
