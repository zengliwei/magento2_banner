<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Controller\Adminhtml\Item;

use CrazyCat\Banner\Model\Group\Item;
use CrazyCat\Base\Controller\Adminhtml\AbstractSaveAction;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
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
}
