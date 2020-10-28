<?php

namespace Common\Banner\Controller\Adminhtml\Item;

use Common\Banner\Model\Group\Item;
use Common\Base\Controller\Adminhtml\AbstractMassSaveAction;

class MassSave extends AbstractMassSaveAction
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->save(Item::class);
    }
}
