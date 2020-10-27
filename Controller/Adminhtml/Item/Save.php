<?php

namespace Common\Banner\Controller\Adminhtml\Item;

use Common\Base\Controller\Adminhtml\AbstractSaveAction;
use Common\Banner\Model\Group\Item;

class Save extends AbstractSaveAction
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->save(
            Item::class,
            'Specified item does not exist.',
            'Banner item saved successfully.',
            'banner_item'
        );
    }
}
