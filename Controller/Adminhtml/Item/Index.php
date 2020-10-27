<?php

namespace Common\Banner\Controller\Adminhtml\Item;

use Common\Base\Controller\Adminhtml\AbstractIndexAction;

class Index extends AbstractIndexAction
{
    public const ADMIN_RESOURCE = 'Common_Banner::banner_item';

    /**
     * @inheritDoc
     */
    public function execute()
    {
        return $this->render(
            'banner_item',
            'Common_Banner::banner_item',
            'Banner Items'
        );
    }
}
