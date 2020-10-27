<?php

namespace Common\Banner\Controller\Adminhtml\Group;

use Common\Base\Controller\Adminhtml\AbstractDeleteAction;
use Common\Banner\Model\Group;

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
