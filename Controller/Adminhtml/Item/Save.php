<?php

namespace Common\Banner\Controller\Adminhtml\Item;

use Common\Base\Controller\Adminhtml\AbstractSaveAction;
use Common\Banner\Model\Group\Item;

class Save extends AbstractSaveAction
{
    /**
     * @inheritDoc
     */
    protected function processData(array $data): array
    {
        if (!empty($data[$data['type']])) {
            $data['media'] = $data[$data['type']][0]['file'];
        }
        return parent::processData($data);
    }

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
