<?php

namespace Common\Banner\Controller\Adminhtml\Item;

use Common\Base\Controller\Adminhtml\AbstractDeleteAction;
use Common\Banner\Model\Group\Item;

class Delete extends AbstractDeleteAction
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->delete(
            Item::class,
            'Specified item does not exist.',
            'Banner item deleted.'
        );
    }
}
