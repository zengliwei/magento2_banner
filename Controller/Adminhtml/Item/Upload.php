<?php

namespace Common\Banner\Controller\Adminhtml\Item;

use Common\Base\Controller\Adminhtml\AbstractUploadAction;
use Common\Banner\Model\Group\Item;

class Upload extends AbstractUploadAction
{
    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->processResult($this->save(Item::MEDIA_FOLDER));
    }
}
