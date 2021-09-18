<?php
/**
 * Copyright (c) Zengliwei. All rights reserved.
 * Each source file in this distribution is licensed under OSL 3.0, see LICENSE for details.
 */

namespace CrazyCat\Banner\Ui\Component\Group\Item;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * @author  Zengliwei <zengliwei@163.com>
 * @url https://github.com/zengliwei/magento2_banner
 */
class Types implements OptionSourceInterface
{
    /**
     * @inheritDoc
     */
    public function toOptionArray()
    {
        return [
            ['label' => 'Image', 'value' => 'image'],
            ['label' => 'Video', 'value' => 'video']
        ];
    }
}
